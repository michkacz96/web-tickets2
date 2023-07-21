<?php

namespace Database\Factories\Helpers;

class CustomerContactHelper{
    
    /**
     * SGenerate tags
     * @param int $numberOfTags number of tags to generate
     * @param string $separator character to seperate tags. Default ;
     * @return string string of tags separated by $separator
     */
    public static function generateTags(int $numberOfTags, string $separator = ';') : string{
        $tagStr = "";

        if($numberOfTags < 1){
            return $tagStr;
        }

        for($i = 0; $i < $numberOfTags; $i++){
            $tagStr .= fake()->word().$separator;
        }

        return (string) substr_replace($tagStr, "", -1);
    }
}
