{"changed":true,"filter":false,"title":"Images.php","tooltip":"/vendor/ebess/advanced-nova-media-library/src/Fields/Images.php","value":"<?php\n\nnamespace Ebess\\AdvancedNovaMediaLibrary\\Fields;\n\nclass Images extends Media\n{\n    protected $defaultValidatorRules = ['image'];\n\n    public function __construct($name, $attribute = null, callable $resolveCallback = null)\n    {\n        parent::__construct($name, $attribute, $resolveCallback);\n\n        $this->croppable(config('nova-media-library.default-croppable', true));\n    }\n\n    /**\n     * Do we deprecate this for SingleMediaRules?\n     * @param $singleImageRules\n     * @return Images\n     */\n    public function singleImageRules($singleImageRules): self\n    {\n        $this->singleMediaRules = $singleImageRules;\n\n        return $this;\n    }\n\n    public function croppable(bool $croppable): self\n    {\n        return $this->withMeta(compact('croppable'));\n    }\n\n    public function croppingConfigs(array $configs): self\n    {\n        return $this->withMeta(['croppingConfigs' => $configs]);\n    }\n\n    public function showStatistics(bool $showStatistics = true): self\n    {\n        return $this->withMeta(compact('showStatistics'));\n    }\n\n    public function showDimensions(bool $showDimensions = true): self\n    {\n        return $this->showStatistics();\n    }\n\n    public function mustCrop(bool $mustCrop = true): self\n    {\n        return $this->withMeta(['mustCrop' => $mustCrop]);\n    }\n}\n","undoManager":{"mark":1,"position":-1,"stack":[[{"start":{"row":44,"column":23},"end":{"row":44,"column":24},"action":"remove","lines":["$"],"id":3},{"start":{"row":44,"column":22},"end":{"row":44,"column":23},"action":"remove","lines":["s"]}],[{"start":{"row":44,"column":23},"end":{"row":44,"column":38},"action":"remove","lines":["howStatistics()"],"id":3},{"start":{"row":44,"column":23},"end":{"row":44,"column":32},"action":"insert","lines":["$fileName"]}]]},"ace":{"folds":[],"scrolltop":387.5999999999999,"scrollleft":0,"selection":{"start":{"row":41,"column":0},"end":{"row":41,"column":0},"isBackwards":false},"options":{"guessTabSize":true,"useWrapMode":false,"wrapToView":true},"firstLineState":{"row":23,"state":"php-start","mode":"ace/mode/php"}},"timestamp":1689204283866}