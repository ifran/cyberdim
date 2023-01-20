var PATH_IMG = 'public/assets/img/';

function _$(iId) 
{
    return document.getElementById(iId);
}

function redirectPage(sPage) 
{
  window.location.href = sPage;
}

function ajaxRequest(sUrl, sDivId = '')
{
    sUrl = 'Application/' + sUrl;
    var oXmlhttp = new XMLHttpRequest();
    
    oXmlhttp.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200) 
      {
        if (this.responseText != '') 
        {
            if (sDivId != '') 
            {
                sDiv = this.responseText;
                _$(sDivId).innerHTML = _$(sDivId).innerHTML + sDiv;
            }
        }
      }
    };
  
    oXmlhttp.open("GET", sUrl , true);
    oXmlhttp.send();
}

function ajaxRequestAppend(sUrl, sDiv = '')
{
    sUrl = '../Application/' + sUrl
    var oXmlhttp = new XMLHttpRequest();
    
    oXmlhttp.onreadystatechange = function() 
    {
        console.log(this);
        
        if (this.readyState == 4 && this.status == 200) 
        {
            if (this.responseText != '') 
            {
                $('#' + sDiv).append(this.responseText);
            }
        }
    };
  
    oXmlhttp.open("GET", sUrl , true);
    oXmlhttp.send();
}

function ajaxValorProduto(sUrl, sDivId = '')
{
    sUrl = 'Application/' + sUrl;
    var oXmlhttp = new XMLHttpRequest();
    
    oXmlhttp.onreadystatechange = function() 
    {
      if (this.readyState == 4 && this.status == 200) 
      {
        if (this.responseText != '') 
        {
            if (sDivId != '') 
            {
                sDiv = this.responseText;
                _$(sDivId).innerHTML = _$(sDivId).innerHTML + sDiv;
                vendaTotal();
            }
        }
      }
    };
  
    oXmlhttp.open("GET", sUrl , true);
    oXmlhttp.send();
}

function roundNumber(num, dec) {
    var result = Math.round(num*Math.pow(10,dec))/Math.pow(10,dec);
    return result;
}  

function fmt2Calc(sVal) 
{
    if (sVal == '') {
        sVal = '0';
    }
    
    if (typeof sVal === 'string') {
        sVal = sVal.toString();
    }

    sVal = sVal.replaceAll('.', '');
    sVal = sVal.replace(',', '.');
    fVal = parseFloat(sVal);
    return fVal;
}

function fmt2Show(fVal, iDecPlace, bFormatSeparator) 
{
    if (iDecPlace == undefined) {
        iDecPlace = 2;
    }
    
    if (bFormatSeparator == undefined) {
        bFormatSeparator = false;
    }
    
    fVal = roundNumber(fVal, iDecPlace);
    sVal = fVal + '';
    sVal = sVal.replace(',', '');
    sVal = sVal.replace('.', ',');

    if (sVal.indexOf(',') < 0) {
        sVal = sVal + ',00';
    }

    if (bFormatSeparator) {
        sVal = fmt2Calc(sVal).toLocaleString('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2});
    }

    return sVal;
}