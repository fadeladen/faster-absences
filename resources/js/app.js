require("select2");
import $ from "jquery";
// Jquery
window.$ = window.jQuery = $;

const bootstrap = require('bootstrap')
window.bootstrap = bootstrap

// datatables
import dt from "datatables.net";
require('datatables.net-bs5')
window.$.DataTable = dt;

// dayjs
const dayjs = require('dayjs')
window.dayjs = dayjs

import { initFormAjax, initDatatable } from "./helpers";
window.initDatatable = initDatatable
window.initFormAjax = initFormAjax

window.Swal = require('sweetalert2');