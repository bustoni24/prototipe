<?php

class Helper {

    public function resizer($photo)
    {
        // Get the image info from the photo
        $image_info = getimagesize($photo);
        $width = $new_width = $image_info[0];
        $height = $new_height = $image_info[1];
        $type = $image_info[2];

        // Load the image
        switch ($type)
        {
            case IMAGETYPE_JPEG:
            $image = imagecreatefromjpeg($photo);
            break;
            case IMAGETYPE_GIF:
            $image = imagecreatefromgif($photo);
            break;
            case IMAGETYPE_PNG:
            $image = imagecreatefrompng($photo);
            break;
            default:
            die('Error loading '.$photo.' - File type '.$type.' not supported');
        }

// Create a new, resized image
        $new_width = 500;
        $new_height = $height / ($width / $new_width);
        $new_image = imagecreatetruecolor($new_width, $new_height);
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

// Save the new image over the top of the original photo
        switch ($type)
        {
            case IMAGETYPE_JPEG:
            imagejpeg($new_image, $photo, 500);
            break;
            case IMAGETYPE_GIF:
            imagegif($new_image, $photo);         
            break;
            case IMAGETYPE_PNG:
            imagepng($new_image, $photo);
            break;
            default:
            die('Error saving image: '.$photo);
        }

    }

    public function resize($namafile){
        try {
            $key = "";
            // $input = "logotest.png";
            // $output = "Output.png";
            $input = $namafile;
            $output = $namafile;
            $url = "https://api.tinify.com/shrink";
            $options = array(
              "http" => array(
                "method" => "POST",
                "header" => array(
                  "Content-type: image/png",
                  "Authorization: Basic " . base64_encode("api:$key")
                ),
                "content" => file_get_contents($input)
              ),
              "ssl" => array(
                /* Uncomment below if you have trouble validating our SSL certificate.
                   Download cacert.pem from: http://curl.haxx.se/ca/cacert.pem */
                 "cafile" => dirname(__FILE__) ."/../../cacert.pem",
                "verify_peer" => false
              )
            );

            $result = @fopen($url, "r", false, stream_context_create($options));
            if ($result) {
              /* Compression was successful, retrieve output from Location header. */
              foreach ($http_response_header as $header) {
                if (substr($header, 0, 10) === "Location: ") {
                  file_put_contents($output, fopen(substr($header, 10), "rb", false));
                  // print("Compression success");
                }
              }
            } else {
              /* Something went wrong! */
              // print("Compression failed");
            }
        } catch (Exception $e) {
            // print("Compression failed");
        }
    }

   public function getRupiah($number) {
      if (is_numeric($number) && $number != 0)
        return number_format($number, 0, ",", ".");
      else 
        return $number;
    }

  public function cleanString($string) {
    if (!isset($string))
        return "";
        
    $find = ['/\n/', '/&nbsp;/', '/&bull;/', '/"/'];
    $replace = [' ', '', '', ""];

    $string = preg_replace($find, $replace, $string);
    $string = strip_tags($string);
    $string = str_replace('\n', ' ', $string);
    $string = str_replace('\t', '', $string);
    $string = str_replace('\r', ' ', $string);
    $string = str_replace('\\', '', $string);
    $string = trim(preg_replace('/\s\s+/', ' ', $string));

    return $string;
 }

 public function remove_emoji($string)
  {

      // Match Emoticons
      $regex_emoticons = '/[\x{1F600}-\x{1F64F}]/u';
      $clear_string = preg_replace($regex_emoticons, '', $string);

      // Match Miscellaneous Symbols and Pictographs
      $regex_symbols = '/[\x{1F300}-\x{1F5FF}]/u';
      $clear_string = preg_replace($regex_symbols, '', $clear_string);

      // Match Transport And Map Symbols
      $regex_transport = '/[\x{1F680}-\x{1F6FF}]/u';
      $clear_string = preg_replace($regex_transport, '', $clear_string);

      // Match Miscellaneous Symbols
      $regex_misc = '/[\x{2600}-\x{26FF}]/u';
      $clear_string = preg_replace($regex_misc, '', $clear_string);

      // Match Dingbats
      $regex_dingbats = '/[\x{2700}-\x{27BF}]/u';
      $clear_string = preg_replace($regex_dingbats, '', $clear_string);

      return $clear_string;
  }

  public function getID($model = null, $prefix = null, $length = 3, $otherData = [])
   {
      if (!isset($model, $prefix))
        return null;
      
        $uniqueId = "";
        $data = $model::model()->find(['order' => 'id DESC']);
        $lastID = 0;
        if (isset($data)) {
          $lastID = $data->id;
        }
        $nextNoUrut = $lastID + 1;
        $unique = false;
        while ($unique == false) {
            $uniqueId = $prefix."-".sprintf("%0". $length ."s",$nextNoUrut)."-".date('YmdHis');

            if (!Yii::app()->db->createCommand("SELECT id FROM ". $otherData['table_name'] ." WHERE ". $otherData['column'] ." = '" . $uniqueId . "'")->queryRow()) {
                $unique = true;
            }
        }

        return $uniqueId;
   }

  public function hashPassword($password)
  {
      if (!isset($password))
          return "";

      return hash_hmac("sha256", $password, 'AIza2tyu5');
  }

  public function setState($name = null, $value = null)
  {
    $result = null;
    if (!isset($name)) {
      return $result;
    }
    Yii::app()->user->setState($name, $value);
  }

  public function getState($name = null)
  {
    $result = [];
    if (!isset($name)) {
      return $result;
    }
      if (Yii::app()->user->getState($name) !== null) {
        $result = Yii::app()->user->getState($name);
      }
    return $result;
  }

   public function dump($data = [])
   {
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    exit;
   }

    private static $instance;

    private function __construct()
    {
        // Hide the constructor
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}