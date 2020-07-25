<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Orchestra\Parser\Xml\Facade as XmlParser;

class APIController extends Controller
{
    public function index()
    {
        // echo "Index method called";

       // For testing
        // $file = public_path('data/data.xml'); 
        // $xml = XmlParser::load($file);
        // $user = $xml->parse([
        //     'id' => ['uses' => 'user.id'],
        //     'email' => ['uses' => 'user.email'],
        //     'followers' => ['uses' => 'user::followers'],
        // ]);
       // For testing end

  //-----------------------------------------------------------------
    //    // xml file path 
    //    $path =  public_path('data/103726.xml');
         
    //    // Read entire file into string 
    //    $xmlfile = file_get_contents($path); 
         
    //    // Convert xml string into an object 
    //    $new = simplexml_load_string($xmlfile); 
         
    //    // Convert into json 
    //    $con = json_encode($new); 
         
    //    // Convert into associative array 
    //    $newArr = json_decode($con, true); 
         
    // //   print_r($newArr); 

    //     dd($newArr);
    //     return Response::json(["Data"=>$user]);


    //The XML string that you want to send.
    $xml = '<?xml version="1.0" encoding="UTF-8"?>
    <depositDetailsRequest>
    <fromDate>2017-08-22</fromDate>
    <toDate>2017-09-22</toDate>
    <transType>DR</transType>
    <agents>
    <agentId>CC01CC01513515340681</agentId>
    </agents>
    </depositDetailsRequest>';
     
     
    //The URL that you want to send your XML to.
    $url = 'https://api.billavenue.com/billpay/enquireDeposit/fetchDetails/xml';
     
    //Initiate cURL
    $curl = curl_init($url);
     
    //Set the Content-Type to text/xml.
    curl_setopt ($curl, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
     
    //Set CURLOPT_POST to true to send a POST request.
    curl_setopt($curl, CURLOPT_POST, true);
     
    //Attach the XML string to the body of our request.
    curl_setopt($curl, CURLOPT_POSTFIELDS, $xml);
     
    //Tell cURL that we want the response to be returned as
    //a string instead of being dumped to the output.
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
     
    //Execute the POST request and send our XML.
    $result = curl_exec($curl);
     
    //Do some basic error checking.
    if(curl_errno($curl)){
        throw new \Exception(curl_error($curl));
    }
     
    //Close the cURL handle.
    curl_close($curl);
     
    //Print out the response output.
    echo $result;





    }   
}
