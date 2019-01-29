<?php
/*
# @Author: Rolind Roy <rolindroy>
# @Date:   2018-02-12T12:29:57+05:30
# @Email:  rolind.roy@tatacommunications.com
# @Filename: index.php
# @Last modified by:   rolindroy
# @Last modified time: 2018-02-15T16:41:29+05:30
*/

define('ROOT', dirname(dirname(__FILE__)));
require_once ROOT . '/includes/autoload.php';

$client = new \GuzzleHttp\Client();
$httpProtocol = "http://";
if (AppConfig::config('api.isSecure') == TRUE)
{
  $httpProtocol = "https://";
}
?>
<script type="text/javascript" src="assets/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript" language="javascript">

function placeRequest()
{
    event.preventDefault();
    var action = $("form").attr("action");
    var indexes = document.getElementById('index_list').value;
    action="index.php?start=0&_search=" + indexes;
    window.location.href = action;
}

function start()
{
    // event.preventDefault();
    // var action = $("form").attr("action");
    // var indexes = document.getElementById('index_list').value;
    action="index.php?start=0";
    window.location.href = action;
}

function setData()
{
  $('#loading span').text('Generating Sample Data.. Please wait..');
    $.ajax({
        type: "POST",
        url: "setData.php",
        data: { name: "John" }
        }).done(function( msg ) {
        $('#loading span').text('Sample Data has been generated, Please reload the page to continue..');
    });
}

function download(filename, text)
{
    var element = document.createElement('a');
    textval = atob(text);
    filename = filename + ".txt"
    element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(textval));
    element.setAttribute('download', filename);
    element.style.display = 'none';
    document.body.appendChild(element);
    element.click();
    document.body.removeChild(element);
}
</script>

<style>
  table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
  }
  th, td {
    padding: 5px;
    text-align: left;
  }

</style>
<h1>Kubernetes Sample Web Application </h1> </br> </br>
<button onclick="setData()">Click here to Genarate sample Data</button>
</br> </br> <div id="loading"><span> </span></div>
</br> </br> </br>
<button onclick="start()">Click here to Start</button>
<?php
if (isset($_GET['start'])&& $_GET["start"] != "")
{
$response = $client->request('GET', $httpProtocol . AppConfig::config('api.url').'/getindex');

if ($response->getStatusCode() == "200")
{
  $responseData = $response->getBody();
  $indices = json_decode($responseData);
  if(is_array($indices) && count($indices) > 0)
  {
    ?>
    <form>
        <select id="index_list">
            <?php
            for ($ind = 0; $ind <= count($indices); $ind++)
            {
                $indices_arr = (array) $indices[$ind];
                // print_r($indices_arr);

                $item = $indices_arr['index'];
                if ((substr( $item, 0, 1 ) != ".") && ($item != ""))
                {
                  ?>
                    <option value="<?php echo strtolower($item); ?>"><?php echo $item; ?></option>
                  <?php
                }
            }
            ?>
        </select>
         <button onclick="placeRequest()">Place Request</button>
    </form>
    <?php
  }

  if(isset($_GET["_search"]) && $_GET["_search"] != "")
  {
    $searchPt = $_GET["_search"];
    if (isset($_GET["_id"]) && $_GET["_id"] != "")
    {
      $requestPt = "/getdatabyid/" . $searchPt . "/" . $_GET["_id"];
      $res_getdatabyid = $client->request('GET', $httpProtocol . AppConfig::config('api.url') . $requestPt );
      if ($res_getdatabyid->getStatusCode() == "200")
      {
        $responseIdData = $res_getdatabyid->getBody();
        $idData = (array) json_decode($responseIdData);
        if (isset($idData['total']) && $idData['total'] > 0)
        {
          echo "<pre>";
          $hits = (array) $idData['hits'][0];
          $source = (array) $hits['_source'];
          echo '<table style="width:100%" >';
          echo '<thead><tr><th>ID</th><th>Source Data</th></tr></thead>';
          echo '<tr>';
          echo '<td>'.$_GET["_id"].'</td>';
            echo '<td>';
            print_r($source);
            echo '</td>';
            echo '</tr>';
            echo '</table>';
          }
        }
      }
      else {
        $requestPt = "/getdatabyindex/" . $searchPt;
        $res_getdatabyindex = $client->request('GET', $httpProtocol . AppConfig::config('api.url') . $requestPt );
        if ($res_getdatabyindex->getStatusCode() == "200")
        {
          $responseDataAll = $res_getdatabyindex->getBody();
          $data = (array) json_decode($responseDataAll);
          if(isset($data['total']) && $data['total'] > 0)
          {
            echo '<pre>';
            echo '<table style="width:100%" >';
            echo '<thead><tr><th>Index</th><th>Type</th><th>ID</th></tr></thead>';
            for ($dtSource = 0; $dtSource <= $data['total']; $dtSource++)
            {
              $hits = (array) $data['hits'][$dtSource];
              $curIndex = $hits['_index'];
              $type = $hits['_type'];
              $id = $hits['_id'];
              if ($id != "")
              {
                echo '<tr>';
                echo '<td>'.$curIndex.'</td>';
                echo '<td>'.$type.'</td>';
                echo '<td><a href=index.php?start=0&_search='.$curIndex.'&_id='.$id.'>'.$id.'</a></td>';
                echo '</tr>';
              }
            }
            echo '</table>';
          }
          else {
           echo "No data found!";
          }
        }
      }
    }
  }
}
?>
