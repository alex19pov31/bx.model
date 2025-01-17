<?php


namespace Bx\Model\UI\Fields;


use Bitrix\Main\UI\Filter\Options;

class NumberFilterField extends BaseFilterField
{
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->title,
            'type' => 'number',
            'default' => $this->isDefault,
        ];
    }

    public function getFilterField(Options $options): array
    {
        $data = $this->getOptionsFilter($options);
        $from = $data[$this->id.'_from'] ?? null;
        $to = $data[$this->id.'_to'] ?? null;
        $mFrom = (int)$from+1;
        $mTo = (int)$to-1;

        $type = $data[$this->id.'_numsel'] ?? null;
        switch ($type) {
            case 'range':
                $filter = [];
                if (!empty($from)) {
                    $filter['from_'.$this->id] = $mFrom;
                }

                if (!empty($to)) {
                    $filter['to_'.$this->id] = $mTo;
                }

                return $filter;
            case 'more':
                $filter = [];
                if (!empty($from)) {
                    $filter['from_'.$this->id] = $mFrom;
                }

                return $filter;
            case 'less':
                $filter = [];
                if (!empty($to)) {
                    $filter['to_'.$this->id] = $mTo;
                }

                return $filter;
            default:
                $filter = [];
                if (!empty($from)) {
                    $filter[$this->id] = $mFrom;
                }

                if (!empty($to)) {
                    $filter[$this->id] = $mTo;
                }

                return $filter;
        }
    }
}