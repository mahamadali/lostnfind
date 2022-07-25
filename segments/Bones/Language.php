<?php

namespace Bones;

use JollyException\BadMethodException;

class Language
{
    protected $translations_dir = 'locker/translations';

    public function __trans($word = '', $data = [])
    {
        if (Str::empty($word)) {
            return $word;
        }

        return $this->transWord($word, (!empty(session()->getLanguage())) ? session()->getLanguage() : setting('app.default_lang'), $data);
    }

    public function __transWord($word, $language, $data = [])
    {
        if (Str::empty($word))
            return $word;

        if (empty(trim($language)))
            $language = (!empty(session()->getLanguage())) ? session()->getLanguage() : setting('app.default_lang');
        
        if (!file_exists($this->translations_dir .'/'.$language.'.php'))
            $language = setting('app.default_lang');

        $translated = findFileVariableByKey($this->translations_dir, $language . '.' . $word, $word);
        
        return $this->__mapWithData($translated, $data);
    }

    public function __mapWithData($translated, $data)
    {
        if (!empty($data)) {
            foreach ($data as $varName => $varValue) {
                $translated = preg_replace('/{{\s+'.$varName.'\s+}}/', '{{'.$varName.'}}', $translated);
                preg_match('/{{'.$varName.'}}/i', $translated, $placeholderMatches);
                if (!empty($placeholderMatches) && !empty($placeholderMatches[0])) {

                    $placeholder = Str::removeWords($placeholderMatches[0], ['{{', '}}']);

                    if (Str::isInUpperCase($placeholder)) {
                        $varValue = strtoupper($varValue);
                    } else if (Str::isInLowerCase($placeholder)) {
                        $varValue = strtolower($varValue);
                    } else if (Str::isCapitalized($placeholder)) {
                        $varValue = ucfirst($varValue);
                    }

                    $translated = Str::multiReplace($translated, ['{{' . $varName . '}}'], [$varValue]);
                }
            }
        }

        return $translated;
    }

    public static function __callStatic($method, $parameters)
    {
        if (method_exists((new static), '__'.$method)) {
            return (new static)->{'__'.$method}(...$parameters);
        }

        throw new BadMethodException('Method {'.$method.'} not found in '.(new static)->model);
    }

    public function __call(string $method, $parameters)
    {
        if (method_exists($this, '__'.$method)) {
            return $this->{'__'.$method}(...$parameters);
        }

        throw new BadMethodException('Method {'.$method.'} not found in '.$this->model);
    }

}