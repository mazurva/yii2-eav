<?php
/**
 * @author Alexey Samoylov <alexey.samoylov@gmail.com>
 */

namespace mazurva\eav\inputs;

use mazurva\eav\handlers\AttributeHandler;
use yii\helpers\ArrayHelper;

class RadioList extends AttributeHandler
{
    const VALUE_HANDLER_CLASS = '\mazurva\eav\handlers\OptionValueHandler';

    public function init()
    {
        parent::init();

        $this->owner->addRule($this->getAttributeName(), 'in', [
            'range' => $this->getOptions(),
        ]);
    }

    public function run()
    {
        return $this->owner->activeForm->field($this->owner, $this->getAttributeName())
            ->radioList(
                ArrayHelper::map($this->attributeModel->getOptions()->asArray()->all(), 'id', 'value')
            );
    }
}