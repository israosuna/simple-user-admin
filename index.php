<?php

session_start();
include_once 'connect.php';

if(!isset($_SESSION['username']))
{
    header("Location: ../login.php");
}

$username = $_SESSION['username'];

require "vendor/autoload.php";
use CrudKit\CrudKitApp;
use CrudKit\Pages\SQLiteTablePage;
use CrudKit\Pages\BasicLoginPage;
use CrudKit\Pages\MySQLTablePage;

// Create a new CrudKitApp object
$app = new CrudKitApp ();
$app->setStaticRoot ("static/crudkit/");
$app->setAppName ("Administrador de Usuarios");



$mysql_page = new MySQLTablePage ("username", "", "", ""); // Set a unique PAge ID too
$mysql_page->setName("clientes nuevos")
    ->setTableName("username")
    ->setRowsPerPage (50)
    ->setPrimaryColumn("id")
    ->addColumn("username", "Email Cliente", array(
        'required' => true
    ))
    ->addColumn("password", "Clave Encriptada")
    ->addColumn("estado", "Estado Cliente", array(
        'required' => true
    ))
    ->addColumn("verf_pp", "Paypal")
    ->addColumn("verf_payza", "Payza")
    ->addColumn("verf_payoneer", "Payoneer")
    ->addColumn("verf_bofa", "BOFA")
    ->addColumn("verf_giftcards", "GiftCards")
    ->addColumn("verf_btc", "BTC")
    ->addColumn("notas", "Notas")

    ->setSummaryColumns(array("username","estado","verf_pp","verf_payza","verf_payoneer","verf_bofa","verf_giftcards","verf_btc","notas"));

$app->addPage($mysql_page);

// Render the app. This will display the HTML
$app->render ();
