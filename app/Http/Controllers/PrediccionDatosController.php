<?php
/** -- -------------------------------------------------------------
*   -- Nombre:      Proyecto Coyuntura
*   -- Organización:Escuela Politécnica Superior
*   -- Autor:       Raquel Sancha Sánchez
*   -- Fecha:       octubre de 2020
*   -- Versión:     1.0
*   -- -------------------------------------------------------------
*/
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Rubix\ML\Datasets\Labeled;
use Rubix\ML\Datasets\Unlabeled;

use Rubix\ML\Regressors\ExtraTreeRegressor;

use Rubix\ML\Regressors\MLPRegressor;
use Rubix\ML\NeuralNet\CostFunctions\LeastSquares;
use Rubix\ML\NeuralNet\Layers\Dense;
use Rubix\ML\NeuralNet\Layers\Activation;
use Rubix\ML\NeuralNet\ActivationFunctions\ReLU;
use Rubix\ML\NeuralNet\Optimizers\RMSProp;
use Rubix\ML\CrossValidation\Metrics\RSquared;

use Rubix\ML\Regressors\GradientBoost;
use Rubix\ML\Regressors\RegressionTree;
use Rubix\ML\CrossValidation\Metrics\SMAPE;
use Rubix\ML\Regressors\DummyRegressor;
use Rubix\ML\Other\Strategies\Constant;

use Rubix\ML\Regressors\Adaline;
use Rubix\ML\NeuralNet\Optimizers\Adam;
use Rubix\ML\NeuralNet\CostFunctions\HuberLoss;

use Rubix\ML\Classifiers\SVR;
use Rubix\ML\Kernels\SVM\RBF;

use Rubix\ML\Regressors\KDNeighborsRegressor;
use Rubix\ML\Graph\Trees\BallTree;

use Rubix\ML\Regressors\KNNRegressor;
use Rubix\ML\Kernels\Distance\SafeEuclidean;

use Rubix\ML\Regressors\RadiusNeighborsRegressor;
use Rubix\ML\Kernels\Distance\Diagonal;

use Rubix\ML\Regressors\Ridge;

/**
* Clase que se encarga de predecir los datos a futuro.
*/
class PrediccionDatosController extends Controller
{
    public function predecir(Request $request,$id){
        $idVariable = $id;
        $years = $request->input("years");
    	$categoria = $request->input("categoria");
        $ambito = $request->input("ambito");
        $idCategoria = DB::select('SELECT idCategoria FROM categoria where Nombre=?',[$categoria]);
        $idAmbito = DB::select('SELECT idAmbito FROM ambito where Nombre=?',[$ambito]);
        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$idVariable]);
        $idCategoria = $idCategoria[0]->idCategoria;
        $idAmbito = $idAmbito[0]->idAmbito;
        $nombreVariable = $nombreVariable[0]->Nombre;
        $variables_aux = DB::select('SELECT idVariable,idCategoria,idAmbito,Mes,Year FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? ORDER BY Year,Mes ASC',[$idVariable,$idCategoria,$idAmbito]);
        $valores_aux = DB::select('SELECT * FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? ORDER BY Year,Mes ASC',[$idVariable,$idCategoria,$idAmbito]);
        $año_aux = DB::select('SELECT Year FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? ORDER BY Year DESC',[$idVariable,$idCategoria,$idAmbito]);
        $año = $año_aux[0]->Year + 1;
        $variables = array();
        $i = 0;
        foreach($variables_aux as $variable){
            $variables[$i] = array();
            array_push($variables[$i], $nombreVariable);
            array_push($variables[$i], $categoria);
            array_push($variables[$i], $ambito);
            array_push($variables[$i], $variable->Mes);
            array_push($variables[$i], $variable->Year);
            $i++;
        }
        $valores=array();
        foreach($valores_aux as $valor){
            if(!empty($valor)){
                array_push($valores,$valor->Valor);
            }
        }
        $datasetTrain = new Labeled($variables,$valores);
        $estimator = new ExtraTreeRegressor(30, 3, 20, 0.05);
        $estimator->train($datasetTrain); 
        $datasetEstimar=array();
        for($j=1; $j<=12; $j++){
            $datasetEstimar[$i] = array();
            array_push($datasetEstimar[$i], $nombreVariable);
            array_push($datasetEstimar[$i], $categoria);
            array_push($datasetEstimar[$i], $ambito);
            array_push($datasetEstimar[$i], $j);
            array_push($datasetEstimar[$i], $año);
            $i++;
        }
        $dataset = new Unlabeled($datasetEstimar);
        $prediccionesExtraTree_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesExtraTree_aux) ; $i++){
            array_push($predicciones,round($prediccionesExtraTree_aux[$i],2));
        }
        $estimator = new GradientBoost(new RegressionTree(3), 0.1, 0.8, 1000, 1e-4, 10, 0.1, new SMAPE(), new DummyRegressor(new Constant(0.0)));
        $estimator->train($datasetTrain); 
        $prediccionesGradientB_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesGradientB_aux) ; $i++){
            array_push($predicciones,round($prediccionesGradientB_aux[$i],2));
        }

        return view('prediccionDatos/predicciones',compact('predicciones','nombreVariable','categoria','ambito','valores','año'));
    }
    public function prueba(Request $request,$id){
        $idVariable = $id;
        $years = $request->input("years");
    	$categoria = $request->input("categoria");
        $ambito = $request->input("ambito");
        $idCategoria = DB::select('SELECT idCategoria FROM categoria where Nombre=?',[$categoria]);
        $idAmbito = DB::select('SELECT idAmbito FROM ambito where Nombre=?',[$ambito]);
        $nombreVariable = DB::select('SELECT Nombre FROM variable where idVariable=?',[$idVariable]);
        $idCategoria = $idCategoria[0]->idCategoria;
        $idAmbito = $idAmbito[0]->idAmbito;
        $nombreVariable = $nombreVariable[0]->Nombre;
        $variables_aux = DB::select('SELECT idVariable,idCategoria,idAmbito,Mes,Year FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? ORDER BY Year ASC',[$idVariable,$idCategoria,$idAmbito]);
        $valores_aux = DB::select('SELECT * FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=?  ORDER BY Year ASC',[$idVariable,$idCategoria,$idAmbito]);
        $año_aux = DB::select('SELECT Year FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? ORDER BY Year DESC',[$idVariable,$idCategoria,$idAmbito]);
        $valoresReales_aux= DB::select('SELECT * FROM variableambitocategoria WHERE idVariable=? AND idCategoria=? AND idAmbito=? AND Year=2019 ORDER BY Mes ASC',[$idVariable,$idCategoria,$idAmbito]);
        $valoresReales=array();
        foreach($valoresReales_aux as $valorR){
            if(!empty($valorR)){
                array_push($valoresReales,$valorR->Valor);
            }
        }
        $año = $año_aux[0]->Year-1; //vamos a predecir el último año del que tenemos datos
        $variables = array();
        $j = 0;
        for($i= 0;$i<(count($variables_aux)-1);$i++){ //Cogemos todos los valores menos los del último año ya que dejaremos al estimador que los predija
            $variables[$j] = array();
            array_push($variables[$i], $idVariable);
            array_push($variables[$i], $idCategoria);
            array_push($variables[$i], $idAmbito);
            array_push($variables[$i], $variables_aux[$i]->Mes);
            array_push($variables[$i], $variables_aux[$i]->Year);
            $j++;
        }
        $valores=array();
        for($i= 0;$i<(count($valores_aux)-1);$i++){
            if(!empty($valores_aux)){
                array_push($valores,$valores_aux[$i]->Valor);
            }
        }
        $datasetTrain = new Labeled($variables,$valores);
        $datasetEstimar=array();
        for($j=1; $j<=12; $j++){
            $datasetEstimar[$i] = array();
            array_push($datasetEstimar[$i], $idVariable);
            array_push($datasetEstimar[$i], $idCategoria);
            array_push($datasetEstimar[$i], $idAmbito);
            array_push($datasetEstimar[$i], $j);
            array_push($datasetEstimar[$i], $año);
            $i++;
        }
        $dataset = new Unlabeled($datasetEstimar); //Etiquetas que queremos predecir
        //Prueba con el estimador ExtraTreeRegressor
        /*
        $estimator = new ExtraTreeRegressor(30, 3, 20, 0.05);
        $estimator->train($datasetTrain); 
        $prediccionesExtraTree_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesExtraTree_aux) ; $i++){
            array_push($predicciones,round($prediccionesExtraTree_aux[$i],2));
        }
        */
        //Prueba con el estimador GradientBoost
        /*
        $estimator = new GradientBoost(new RegressionTree(3), 0.1, 0.8, 1000, 1e-4, 10, 0.1, new SMAPE(), new DummyRegressor(new Constant(0.0)));
        $estimator->train($datasetTrain); 
        $prediccionesGradientB_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesGradientB_aux) ; $i++){
            array_push($predicciones,round($prediccionesGradientB_aux[$i],2));
        }
        */
        //Prueba con el estimador Adaline INCOMPATIBLE
        /*
        $estimator = new Adaline(100, new Adam(0.001), 1e-4, 500, 1e-6, 5, new HuberLoss(2.5));
        $estimator->train($datasetTrain); 
        $prediccionesAdaline_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesAdaline_aux) ; $i++){
            array_push($predicciones,round($prediccionesAdaline_aux[$i],2));
        }
        */
        //Prueba con el estimador SVR NO LO ENCUENTRA
        /*
        $estimator = new SVR(1.0, 0.03, new RBF(), true, 1e-3, 256.0);
        $estimator->train($datasetTrain); 
        $prediccionesSVR_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesSVR_aux) ; $i++){
            array_push($predicciones,round($prediccionesSVR_aux[$i],2));
        }
        */
        //Prueba con el estimador KDNeighborsRegressor INCOMPATIBLE
        /*
        $estimator = new KDNeighborsRegressor(5, true, new BallTree(50));
        $estimator->train($datasetTrain); 
        $prediccionesKDN_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesKDN_aux) ; $i++){
            array_push($predicciones,round($prediccionesKDN_aux[$i],2));
        }
        */
        //Prueba con el estimador KNN INCOMPATIBLE
        /*
        $estimator = new KNNRegressor(2, false, new SafeEuclidean());
        $estimator->train($datasetTrain); 
        $prediccionesKNN_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesKNN_aux) ; $i++){
            array_push($predicciones,round($prediccionesKNN_aux[$i],2));
        }
        */
        //Prueba con el estimador RadiusNeighborsRegressor INCOMPATIBLE
        /*
        $estimator = new RadiusNeighborsRegressor(0.5, true, new BallTree(30, new Diagonal()));
        $estimator->train($datasetTrain); 
        $prediccionesRadius_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesRadius_aux) ; $i++){
            array_push($predicciones,round($prediccionesRadius_aux[$i],2));
        }
        */
          //Prueba con el estimador Ridge INCOMPATIBLE
        /*
        $estimator = new Ridge(2.0);
        $estimator->train($datasetTrain); 
        $prediccionesRidge_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesRidge_aux) ; $i++){
            array_push($predicciones,round($prediccionesRidge_aux[$i],2));
        }
        */
          //Prueba con el estimador RegressionTree 
        
        $estimator = new RegressionTree(20, 2, 4, 1e-3);
        $estimator->train($datasetTrain); 
        $prediccionesRT_aux = $estimator->predict($dataset);
        $predicciones=array();
        for($i=0; $i<count($prediccionesRT_aux) ; $i++){
            array_push($predicciones,round($prediccionesRT_aux[$i],2));
        }
        
        //Prueba con el estimador MLPRegressor INCOMPATIBLE
        /*
        $estimator = new MLPRegressor([
            new Dense(100),
            new Activation(new ReLU()),
            new Dense(100),
            new Activation(new ReLU()),
            new Dense(50),
            new Activation(new ReLU()),
            new Dense(50),
            new Activation(new ReLU()),
        ], 128, new RMSProp(0.001), 1e-3, 100, 1e-5, 3, 0.1, new LeastSquares(), new RSquared());
        $estimator->train($datasetTrain); 
        $prediccionesMLP = $estimator->predict($dataset);
       */
        return view('prediccionDatos/prueba',compact('predicciones','nombreVariable','categoria','ambito','valoresReales','año'));
    }
        /**
    * Función que se encarga de mostrar las supercategorias, categorias, ambitos y años de una variable pasada por parametro.
    *
    * @param  int  $id
    * @return view
    */
    public function show($id)
    {
    	$supercategorias = DB::select('SELECT DISTINCT Name,supercategoria.idSuperCategoria FROM supercategoria
                                        INNER JOIN categoria on categoria.idSuperCategoria = supercategoria.idSuperCategoria
                                        INNER JOIN variableambitocategoria on variableambitocategoria.idCategoria = categoria.idCategoria and variableambitocategoria.idVariable=?',[$id]);
    	
    	$categorias  = DB::select('SELECT DISTINCT Nombre,idSuperCategoria FROM categoria natural join variableambitocategoria WHERE idVariable=? order by idSuperCategoria,Nombre',[$id]);
    	$years = DB::select('SELECT DISTINCT Year FROM variableambitocategoria where idVariable=? ORDER BY Year ASC',[$id]);
    	$ambitos  = DB::select('SELECT DISTINCT Nombre FROM ambito natural join variableambitocategoria WHERE idVariable=?',[$id]);

    	

		 return view('prediccionDatos.show',compact('categorias','years','id','ambitos','supercategorias'));
    }
    public function traducirMes($mes){
            switch($mes){
                case "1":
                    $mesAux="Enero";
                    break;
                case "2":
                    $mesAux="Febrero";
                    break;
                case "3":
                    $mesAux="Marzo";
                    break;
                case "4":
                    $mesAux="Abril";
                    break; 
                case "5":
                    $mesAux="Mayo";
                    break;   
                case "6":
                    $mesAux="Junio";
                    break;
                case "7":
                    $mesAux="Julio";
                    break;
                case "8":
                    $mesAux="Agosto";
                    break;
                case "9":
                    $mesAux="Septiembre";
                    break; 
                case "10":
                    $mesAux="Octubre";
                    break;
                case "11":
                    $mesAux="Noviembre";
                    break;
                case "12":
                    $mesAux="Diciembre";
                    break;
                }
        return $mesAux;
    }
}