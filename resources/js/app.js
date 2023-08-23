import Alpine from 'alpinejs'
import focus from '@alpinejs/focus'
import flatpickr from "flatpickr";

window.Alpine = Alpine
window.flatpickr = flatpickr

import("./../../node_modules/flatpickr/dist/flatpickr.min.css");
import("./../../vendor/power-components/livewire-powergrid/dist/powergrid.css");
import("./../../vendor/power-components/livewire-powergrid/dist/tom-select.css");

import TomSelect from "tom-select";
window.TomSelect = TomSelect

import './../../vendor/power-components/livewire-powergrid/dist/powergrid'

Alpine.start()
Alpine.plugin(focus)
