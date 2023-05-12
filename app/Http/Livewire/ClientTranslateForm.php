<?php

namespace App\Http\Livewire;

use GuzzleHttp\Client;
use Livewire\Component;

class ClientTranslateForm extends Component
{
    public $clientText;
    public $targetLang = 'EN';
    public $sourceLang;
    public $clientTranslatedText;
    public $lang_codes = [
        "BG" => "Bulgarian",
        "CS" => "Czech",
        "DA" => "Danish",
        "DE" => "German",
        "EL" => "Greek",
        "EN" => "English",
        "ES" => "Spanish",
        "ET" => "Estonian",
        "FI" => "Finnish",
        "FR" => "French",
        "HU" => "Hungarian",
        "ID" => "Indonesian",
        "IT" => "Italian",
        "JA" => "Japanese",
        "KO" => "Korean",
        "LT" => "Lithuanian",
        "LV" => "Latvian",
        "NB" => "Norwegian (Bokmål)",
        "NL" => "Dutch",
        "PL" => "Polish",
        "PT" => "Portuguese (all Portuguese varieties mixed)",
        "RO" => "Romanian",
        "RU" => "Russian",
        "SK" => "Slovak",
        "SL" => "Slovenian",
        "SV" => "Swedish",
        "TR" => "Turkish",
        "UK" => "Ukrainian",
        "ZH" => "Chinese"
    ];


    public function updatedTargetLang()
    {
        if ($this->clientText) {
            $this->clientTranslate();
        }
    }

    public function updatedClientText()
    {
        $this->clientTranslatedText = '';
        $this->dispatchBrowserEvent('clientStopTyping');
        $this->clientTranslate();
    }

    public function clientTranslate()
    {
        $client = new Client();

        $response = $client->request('POST', 'https://api-free.deepl.com/v2/translate', [
            'form_params' => [
                'auth_key' => env('DEEPL_API_KEY'),
                'text' => $this->clientText,
                'target_lang' => $this->targetLang
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        $this->clientTranslatedText = $data['translations'][0]['text'];
        $this->sourceLang = $data['translations'][0]['detected_source_language'];
        $this->emit('sourceLangSent', $this->sourceLang);
    }

    public function updatedSourceLang()
    {
        if ($this->clientText) {
            $this->clientTranslate();
            $this->emit('sourceLangSent', $this->sourceLang);
        }
    }

    public function render()
    {
        return view('livewire.client-translate-form');
    }
}
