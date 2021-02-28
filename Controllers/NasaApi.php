<?php

namespace Controllers;
use \Cache\Cache;

class NasaApi extends \Core\Api
{
    public function index()
    {
        $response = [];
        $daysRange = $this->getLastDays(10);
        
        foreach ($daysRange as $key => $value)
        {
            $fileName = $value . ".txt";
            $formattedContent = [];

            if (Cache::checkFileExist($fileName))
            {
                $formattedContent = json_decode(Cache::readFromFile($fileName), true);
            } else {
                $roversContent = $this->getFromUrl('https://api.nasa.gov/mars-photos/api/v1/rovers/curiosity/photos?earth_date='. $value .'&camera=NAVCAM&api_key=DEMO_KEY');
                
                if (is_array($roversContent['photos']) && count($roversContent['photos']) > 0)
                {
                    foreach ($roversContent['photos'] as $key => $arrayValues)
                    {
                        $formattedContent[] = $arrayValues['img_src'];
                        if ($key == 2)
                        {
                            break;
                        }
                    }
                }
                Cache::storeInFile($fileName, $formattedContent);
            }
            
            $response[$value] = $formattedContent;
        }
        
        $this->setResponse($response);
    }

    public function getLastDays($intLimit)
    {
        $today = date('Y-m-d');
        $days = [];

        for ($i=1; $i<=$intLimit; $i++)
        {
            $days[] = date('Y-m-d', strtotime($today . "-" . $i . "days"));
        }
        return $days;
    }
}
