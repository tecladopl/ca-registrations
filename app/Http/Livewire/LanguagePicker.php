<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \Illuminate\Session\SessionManager;
use App\Models\Localization;
use App\Http\Controllers\LocalizationController;

class LanguagePicker extends Component {

    public $locales;
    public $current_locale;
    public $current_locale_icon_suffix;

    public function mount(SessionManager $session) {
        $this->locales = Localization::all();
        $this->current_locale = app()->getLocale();
        $this->current_locale_icon_suffix = Localization::where('locale',app()->getLocale())->first()->icon_suffix;
    }

    public function render() {
        return view('livewire.language-picker');
    }

    public function changeLocale(string $locale) {
        LocalizationController::setLocale($locale);
        
    }

}