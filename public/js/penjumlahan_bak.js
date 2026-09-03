//Air Sumur
function sum()
{
    var s1l_value = document.getElementById('sumur_1_last').value;
    var s1_value = document.getElementById('sumur_1').value;

    var s1_result = parseInt(s1_value) - parseInt(s1l_value);
    if (!isNaN(s1_result)) {
        document.getElementById('sumur_1_pemakaian').value = s1_result;
    }

    var s2l_value = document.getElementById('sumur_2_last').value;
    var s2_value = document.getElementById('sumur_2').value;

    var s2_result = parseInt(s2_value) - parseInt(s2l_value);
    if (!isNaN(s2_result)) {
        document.getElementById('sumur_2_pemakaian').value = s2_result;
    }

    var s3l_value = document.getElementById('sumur_3_last').value;
    var s3_value = document.getElementById('sumur_3').value;

    var s3_result = parseInt(s3_value) - parseInt(s3l_value);
    if (!isNaN(s3_result)) {
        document.getElementById('sumur_3_pemakaian').value = s3_result;
    }

    var s4l_value = document.getElementById('sumur_4_last').value;
    var s4_value = document.getElementById('sumur_4').value;

    var s4_result = parseInt(s4_value) - parseInt(s4l_value);
    if (!isNaN(s4_result)) {
        document.getElementById('sumur_4_pemakaian').value = s4_result;
    }
}

//Air Produksi
function sumCw()
{
    var cw4l_value = document.getElementById('cw_4_last').value;
    var cw4_value = document.getElementById('cw_4').value;

    var cw4_result = parseInt(cw4_value) - parseInt(cw4l_value);
    if (!isNaN(cw4_result)) {
        document.getElementById('cw_4_pemakaian').value = cw4_result;
    }

    var cw6l_value = document.getElementById('cw_6_last').value;
    var cw6_value = document.getElementById('cw_6').value;

    var cw6_result = parseInt(cw6_value) - parseInt(cw6l_value);
    if (!isNaN(cw6_result)) {
        document.getElementById('cw_6_pemakaian').value = cw6_result;
    }

    var sw4l_value = document.getElementById('sw_4_last').value;
    var sw4_value = document.getElementById('sw_4').value;

    var sw4_result = parseInt(sw4_value) - parseInt(sw4l_value);
    if (!isNaN(sw4_result)) {
        document.getElementById('sw_4_pemakaian').value = sw4_result;
    }

    var sw6l_value = document.getElementById('sw_6_last').value;
    var sw6_value = document.getElementById('sw_6').value;

    var sw6_result = parseInt(sw6_value) - parseInt(sw6l_value);
    if (!isNaN(sw6_result)) {
        document.getElementById('sw_6_pemakaian').value = sw6_result;
    }
}

// Air Boiler
function sumAb()
{
    var ab1l_value = document.getElementById('ab_1_last').value;
    var ab1_value = document.getElementById('ab_1').value;

    var ab1_result = parseInt(ab1_value) - parseInt(ab1l_value);
    if(!isNaN(ab1_result)) {
        document.getElementById('ab_1_pemakaian').value = ab1_result;
    }

    var ab2l_value = document.getElementById('ab_2_last').value;
    var ab2_value = document.getElementById('ab_2').value;

    var ab2_result = parseInt(ab2_value) - parseInt(ab2l_value);
    if(!isNaN(ab2_result)) {
        document.getElementById('ab_2_pemakaian').value = ab2_result;
    }

    var ab3l_value = document.getElementById('ab_3_last').value;
    var ab3_value = document.getElementById('ab_3').value;

    var ab3_result = parseInt(ab3_value) - parseInt(ab3l_value);
    if(!isNaN(ab3_result)) {
        document.getElementById('ab_3_pemakaian').value = ab3_result;
    }
}

//Air Proses
function sumAp()
{
    var swpl_value = document.getElementById('swp_last').value;
    var swp_value = document.getElementById('swp').value;

    var swp_result = parseInt(swp_value) - parseInt(swpl_value);
    if (!isNaN(swp_result)) {
        document.getElementById('swp_pemakaian').value = swp_result;
    }

    var cwgtl_value = document.getElementById('cwgt_last').value;
    var cwgt_value = document.getElementById('cwgt').value;

    var cwgt_result = parseInt(cwgt_value) - parseInt(cwgtl_value);
    if (!isNaN(cwgt_result)) {
        document.getElementById('cwgt_pemakaian').value = cwgt_result;
    }
}

//WTP
function sumWwtp()
{
    var wwtp_in_1l_value = document.getElementById('wwtp_in_1_last').value;
    var wwtp_in_1_value = document.getElementById('wwtp_in_1').value;

    var wwtp_in_1_result = parseInt(wwtp_in_1_value) - parseInt(wwtp_in_1l_value);
    if (!isNaN(wwtp_in_1_result)) {
        document.getElementById('wwtp_in_1_pemakaian').value = wwtp_in_1_result;
    }

    var wwtp_in_2l_value = document.getElementById('wwtp_in_2_last').value;
    var wwtp_in_2_value = document.getElementById('wwtp_in_2').value;

    var wwtp_in_2_result = parseInt(wwtp_in_2_value) - parseInt(wwtp_in_2l_value);
    if (!isNaN(wwtp_in_2_result)) {
        document.getElementById('wwtp_in_2_pemakaian').value = wwtp_in_2_result;
    }

    var wwtp_outl_value = document.getElementById('wwtp_out_last').value;
    var wwtp_out_value = document.getElementById('wwtp_out').value;

    var wwtp_out_result = parseInt(wwtp_out_value) - parseInt(wwtp_outl_value);
    if (!isNaN(wwtp_out_result)) {
        document.getElementById('wwtp_out_pemakaian').value = wwtp_out_result;
    }

    var apl_value = document.getElementById('ap_last').value;
    var ap_value = document.getElementById('ap').value;

    var ap_result = parseInt(ap_value) - parseInt(apl_value);
    if (!isNaN(ap_result)) {
        document.getElementById('ap_pemakaian').value = ap_result;
    }

    var ldl_value = document.getElementById('ld_last').value;
    var ld_value = document.getElementById('ld').value;

    var ld_result = parseInt(ld_value) - parseInt(ldl_value);
    if (!isNaN(ld_result)) {
        document.getElementById('ld_pemakaian').value = ld_result;
    }
}

//GAS
function sumGas(){
    var gasl_value = document.getElementById('gas_last').value;
    var gas_value = document.getElementById('gas').value;
    
    var gas_result = parseInt(gas_value) - parseInt(gasl_value);
    if (!isNaN(gas_result)) {
        document.getElementById('gas_pemakaian').value = gas_result;
    }
    
    var boiler_1_2l_value = document.getElementById('boiler_1_2_last').value;
    var boiler_1_2_value = document.getElementById('boiler_1_2').value;
    
    var boiler_1_2_result = parseInt(boiler_1_2_value) - parseInt(boiler_1_2l_value);
    if (!isNaN(boiler_1_2_result)) {
        document.getElementById('boiler_1_2_pemakaian').value = boiler_1_2_result;
    }

    var boiler_3l_value = document.getElementById('boiler_3_last').value;
    var boiler_3_value = document.getElementById('boiler_3').value;
    
    var boiler_3_result = parseInt(boiler_3_value) - parseInt(boiler_3l_value);
    if (!isNaN(boiler_3_result)) {
        document.getElementById('boiler_3_pemakaian').value = boiler_3_result;
    }

    var total_pemakaian_boiler = boiler_1_2_result + boiler_3_result;
    if(!isNaN(total_pemakaian_boiler)) {
        document.getElementById('total_pemakaian_boiler_1_2_3').value = total_pemakaian_boiler;
    }
}

//STEAM
function sumSteam()
{
    var steam_indukl_value = document.getElementById('steam_induk_last').value;
    var steam_induk_value = document.getElementById('steam_induk').value;

    var steam_induk_result = parseInt(steam_induk_value) - parseInt(steam_indukl_value);
    if(!isNaN(steam_induk_result)){
        document.getElementById('steam_induk_pemakaian').value = steam_induk_result;
    }

    var steam_con_dyeingl_value = document.getElementById('steam_con_dyeing_last').value;
    var steam_con_dyeing_value = document.getElementById('steam_con_dyeing').value;

    var steam_con_dyeing_result = parseInt(steam_con_dyeing_value) - parseInt(steam_con_dyeingl_value);
    if(!isNaN(steam_con_dyeing_result)){
        document.getElementById('steam_con_dyeing_pemakaian').value = steam_con_dyeing_result;
    }
}

//KWH
function sumKwh()
{
    var induk_pln_wbpl_value = document.getElementById('induk_pln_wbp_last').value;
    var induk_pln_wbp_value = document.getElementById('induk_pln_wbp').value;

    var induk_pln_wbp_result = (parseFloat(induk_pln_wbp_value) - parseFloat(induk_pln_wbpl_value)).toFixed(3);
    if(!isNaN(induk_pln_wbp_result)){
        document.getElementById('induk_pln_wbp_pemakaian').value = induk_pln_wbp_result;
    }

    var induk_pln_lwbpl_value = document.getElementById('induk_pln_lwbp_last').value;
    var induk_pln_lwbp_value = document.getElementById('induk_pln_lwbp').value;

    var induk_pln_lwbp_result = (parseFloat(induk_pln_lwbp_value) - parseFloat(induk_pln_lwbpl_value)).toFixed(3);
    if(!isNaN(induk_pln_lwbp_result)){
        document.getElementById('induk_pln_lwbp_pemakaian').value = induk_pln_lwbp_result;
    }

    //KWH WTP
    var kwh_wtp_aml_value = document.getElementById('kwh_wtp_am_last').value;
    var kwh_wtp_am_value = document.getElementById('kwh_wtp_am').value;

    var kwh_wtp_jp_result = (parseInt(kwh_wtp_am_value) - parseInt(kwh_wtp_aml_value)).toFixed(3);
    if (!isNaN(kwh_wtp_jp_result)) {
        document.getElementById('kwh_wtp_jp').value = kwh_wtp_jp_result;
    }

    var kwh_wtp_pemakaian_wbp_result = (4 / 24 * parseInt(kwh_wtp_jp_result)).toFixed(3);
    if (!isNaN(kwh_wtp_pemakaian_wbp_result)) {
        document.getElementById('kwh_wtp_pemakaian_wbp').value = kwh_wtp_pemakaian_wbp_result;
    }

    var kwh_wtp_pemakaian_lwbp_result = (20 / 24 * parseInt(kwh_wtp_jp_result)).toFixed(3);
    if (!isNaN(kwh_wtp_pemakaian_lwbp_result)) {
        document.getElementById('kwh_wtp_pemakaian_lwbp').value = kwh_wtp_pemakaian_lwbp_result;
    }

    //KWH WWTP
    var kwh_wwtp_aml_value = document.getElementById('kwh_wwtp_am_last').value;
    var kwh_wwtp_am_value = document.getElementById('kwh_wwtp_am').value;

    var kwh_wwtp_jp_result = (parseInt(kwh_wwtp_am_value) - parseInt(kwh_wwtp_aml_value)).toFixed(3);
    if (!isNaN(kwh_wwtp_jp_result)) {
        document.getElementById('kwh_wwtp_jp').value = kwh_wwtp_jp_result;
    }

    var kwh_wwtp_pemakaian_wbp_result = (4 / 24 * parseInt(kwh_wwtp_jp_result)).toFixed(3);
    if (!isNaN(kwh_wwtp_pemakaian_wbp_result)) {
        document.getElementById('kwh_wwtp_pemakaian_wbp').value = kwh_wwtp_pemakaian_wbp_result;
    }

    var kwh_wwtp_pemakaian_lwbp_result = (20 / 24 * parseInt(kwh_wwtp_jp_result)).toFixed(3);
    if (!isNaN(kwh_wwtp_pemakaian_lwbp_result)) {
        document.getElementById('kwh_wwtp_pemakaian_lwbp').value = kwh_wwtp_pemakaian_lwbp_result;
    }
}