<?php

use App\Models\Attribute;

class LabelHelper {  

    // Aggiungere statisticamente qui le chiavi che si voglio traddure in Label
    protected $keysLabel = [
        'name' => "Nome",
        'description' => "Descrizione",
        'default' => 'Predefinito',
        'default_emport' => 'Default Exp.',
        'default_import' => 'Default Imp.',
        'use_in_import' => 'Import',
        'use_in_export' => 'Export',
        'hidden_in_view' => 'Nascosto',
        'status' => 'Stato',
        'date_last_import' => 'Dt.Ultimo Import',
        'force_import' => 'Forza Importazione',
        'completed' => 'Completato',
        'completed_date' => 'Data Completato',
    ];

    public function __construct()
    {
        // $attributes = Attribute::all();
        // foreach ($attributes as $attr) {
        //     $this->keysLabel[$attr->col_name] = $attr->label;
        // }
    }
    
    public function getLabel($key)
    {   
        return (array_key_exists($key, $this->keysLabel)) ? $this->keysLabel[$key] : $key;
    }
    
}