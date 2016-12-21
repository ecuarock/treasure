// JavaScript Document
$(document).ready(function(){

	//LISTENER FOR TERMS & CONDITIONS BUTTON
		$("#openTerms").bind("click", function(e){
			window.open(document_root+'media/files/terminos_condiciones.pdf','');
		});
});

function explode (delimiter, string, limit) {
    // Splits a string on string separator and return array of components. If limit is positive only limit number of components is returned. If limit is negative all components except the last abs(limit) are returned.
    //
    // version: 909.322
    // discuss at: http://phpjs.org/functions/explode    // +     original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: kenneth
    // +     improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +     improved by: d3x
    // +     bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)    // *     example 1: explode(' ', 'Kevin van Zonneveld');
    // *     returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    // *     example 2: explode('=', 'a=bc=d', 2);
    // *     returns 2: ['a', 'bc=d']
     var emptyArray = {0: ''};

    // third argument is not required
    if ( arguments.length < 2 ||
        typeof arguments[0] == 'undefined' ||        typeof arguments[1] == 'undefined' )
    {
        return null;
    }
     if ( delimiter === '' ||
        delimiter === false ||
        delimiter === null )
    {
        return false;}

    if ( typeof delimiter == 'function' ||
        typeof delimiter == 'object' ||
        typeof string == 'function' ||        typeof string == 'object' )
    {
        return emptyArray;
    }
     if ( delimiter === true ) {
        delimiter = '1';
    }

    if (!limit) {return string.toString().split(delimiter.toString());
    } else {
        // support for limit argument
        var splitted = string.toString().split(delimiter.toString());
        var partA = splitted.splice(0, limit - 1);var partB = splitted.join(delimiter.toString());
        partA.push(partB);
        return partA;
    }
}
function implode (glue, pieces) {
    // Joins array elements placing glue string between items and return one string
    //
    // version: 911.718
    // discuss at: http://phpjs.org/functions/implode    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Waldo Malqui Silva
    // +   improved by: Itsacon (http://www.itsacon.net/)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);    // *     returns 1: 'Kevin van Zonneveld'
    // *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
    // *     returns 2: 'Kevin van Zonneveld'

    var i = '', retVal='', tGlue='';

    if (arguments.length === 1) {
        pieces = glue;
        glue = '';
    }
    if (typeof(pieces) === 'object') {
        if (pieces instanceof Array) {
            return pieces.join(glue);
        }
        else {
            for (i in pieces) {
                retVal += tGlue + pieces[i];
                tGlue = glue;
            }
            return retVal;
        }
    } else {
        return pieces;
    }
}

/***********************************************
* @Name: array_push
* @Description: Adds an element to an specific array at the end of it.
* @Params: arrayGroup: array stack
*          element: the new element to be added
* @Returns: The new Array
***********************************************/
function array_push ( arrayGroup, element ) {
    var size=arrayGroup.length;
    arrayGroup[size]=element;
    return arrayGroup;
}

/***********************************************
* @Name: setDefaultCalendar
* @Description: sets a datepicker for an specific date textBox, it also calls
*               formatDate() function that is used to control the insertion
*               of a correct date in the textBox.
* @Params:  object: textBox that is going to aply the datepicker and formatDate()
*           min: the min date that is going to accept the calendar
*           max: the max date that is going to accept the calendar
*           defDate: the default date used to initialize the calendar
***********************************************/
function setDefaultCalendar(object, min ,max, defDate){
    object.datepicker({
        showOn: 'button',
        buttonImage: document_root+'media/img/calendar.gif',
        buttonImageOnly: true,
        dateFormat: 'dd/mm/yy'
    });
    object.datepicker('option', {
            dateFormat: 'dd/mm/yy',
            date: object.val(),
            current: object.val(),
            starts: 1,
            position: 'r',
            defaultDate: defDate,
            maxDate: max,
            minDate: min,
            changeMonth: true,
            changeYear: true,
			//yearRange: '1950:2010',
            onBeforeShow: function(){
                    object.DatePickerSetDate(object.val(), true);
            },
            onChange: function(formated, dates){
                    object.val(formated);

            }
    });

    object.keyup(function(){$(this).val(formatDate($(this).val()))});
}

/***********************************************
* @Name: setDefaultCalendar
* @Description: checks if a value is numeric
* @Params:  value
* @Returns: false if it isn't numeric
*           true if it is numeric
***********************************************/
function IsNumeric(value){
    var log=value.length;
    var sw="S";
    for (x=0; x<log; x++) {
        v1=value.substr(x,1);
        v2 = parseInt(v1);
        if (isNaN(v2)) {
            sw= "N";
        }
    }
    if (sw=="S") {
        return true;
    } else {
        return false;
    }
}

/***********************************************
* @Name: setDefaultCalendar
* @Description: function used to control the insertion
*               of a correct date in the textBox in an specific format 'dd/mm/yyyy'.
* @Params:  date: String going to be checked and modified if necesary
* @Returns: date: The modified String
***********************************************/
function formatDate(date){
    var firstlap=false;
    var secondlap=false;
    var date_lng = date.length;
    var day;
    var month;
    var year;
    if ((date_lng>=2) && (firstlap==false)) {
        day=date.substr(0,2);
        if ((IsNumeric(day)==true) && (day<=31) && (day!="00")) {
            date=date.substr(0,2)+"/"+date.substr(3,7);firstlap=true;
        }
        else {
            date="";firstlap=false;
        }
    }else{
        day=date.substr(0,1);
        if (!IsNumeric(day)){
            date="";
        }
        if ((date_lng<=2) && (firstlap=true)) {
            date=date.substr(0,1);firstlap=false;
        }
    }
    if ((date_lng>=5) && (secondlap==false)){
        month=date.substr(3,2);
        if ((IsNumeric(month)==true) &&(month<=12) && (month!="00")) {
            date=date.substr(0,5)+"/"+date.substr(6,4);secondlap=true;
        }else {
            date=date.substr(0,3);;secondlap=false;
        }
    }
    else {
        if ((date_lng<=5) && (secondlap=true)) {
            date=date.substr(0,4);secondlap=false;
        }
    }
    if (date_lng>=7){
        year=date.substr(6,4);
        if (IsNumeric(year)==false) {
            date=date.substr(0,6);
        }
        else {
            if (date_lng==10){
                if ((year==0) || (year<1900) || (year>2100)) {
                    date=date.substr(0,6);
                }
            }
        }
    }
    if (date_lng>=10){
        date=date.substr(0,10);
        day=date.substr(0,2);
        month=date.substr(3,2);
        year=date.substr(6,4);
        if ( (year%4 != 0) && (month ==02) && (day > 28) ) {
            date=date.substr(0,2)+"/";
        }
        if ((month ==02) && (day > 29) ) {
            date=date.substr(0,2)+"/";
        }
    }
    return (date);
}
        /***********************************************
	* function parseDate
	@Name: parseDate
	@Description: Parses a string in format date dd/mm/YYYY to a date
	@Params:
         *       str:string to be parsed
	@Returns: Date object.
        used mostly on dayDiff function
	***********************************************/
function parseDate(str) {
    var mdy = str.split('/')
    return new Date(mdy[2], mdy[1]-1, mdy[0]);
}
        /***********************************************
	* function parseDate
	@Name: parseDate
	@Description: Parses a string in format date dd/mm/YYYY to a date
	@Params:
         *       str:string to be parsed
	@Returns: Date object.
        used mostly on dayDiff function
	***********************************************/
function parseDateTime(str) {
    var mdy = str.split('/')
    var year_time = mdy[2].split(' ');
    var time = year_time[1].split(':');
    var hola = new Date(year_time[0], mdy[1]-1, mdy[0], time[0], time[1], 0, 0)
    return hola;
}
        /***********************************************
	* function dayDiff
	@Name: dayDiff
	@Description: get the days between to dates
	@Params:
         *       first:lower date string format dd/mm/YYYY
         *       second: higher date string format dd/mm/YYYY
	@Returns: int: days between
	***********************************************/
function dayDiff(first, second) {
    var date1=parseDate(first);
    var date2=parseDate(second);
    return ((date2-date1)/(1000*60*60*24))+1;
}

/***********************************************
@Name: dateFormat
@Description: Sets date format from mm/dd/YYYY to dd/mm/YYYY
@Params: Date String
@Returns: Formated Date
***********************************************/
function dateFormat(date){
	var formatDate=date.charAt(3)+'';
	for(var i=4;i<6;i++){
		formatDate+=date.charAt(i);
	}
	for(var i=0;i<3;i++){
		formatDate+=date.charAt(i);
	}
	for(var i=6;i<date.length;i++){
		formatDate+=date.charAt(i);
	}
	return formatDate;
}

function strtolower (str) {
    // Makes a string lowercase
    //
    // version: 909.322
    // discuss at: http://phpjs.org/functions/strtolower    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Onno Marsman
    // *     example 1: strtolower('Kevin van Zonneveld');
    // *     returns 1: 'kevin van zonneveld'
    return (str+'').toLowerCase();
}

function ucwords(str) {
    // Uppercase the first character of every word in a string
    //
    // version: 1001.2911
    // discuss at: http://phpjs.org/functions/ucwords    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Waldo Malqui Silva
    // +   bugfixed by: Onno Marsman
    // +   improved by: Robin
    // *     example 1: ucwords('kevin van zonneveld');    // *     returns 1: 'Kevin Van Zonneveld'
    // *     example 2: ucwords('HELLO WORLD');
    // *     returns 2: 'HELLO WORLD'
    return (str + '').replace(/^(.)|\s(.)/g, function ($1) {
        return $1.toUpperCase();});
}

function show_ajax_loader(){
	$("#spinner").css( 'display', 'block' );
}

function hide_ajax_loader(){
	$("#spinner").css( 'display', 'none' );
}

function validateDates(begin_selector){
	if($(begin_selector).val()!='' && today_selector){
		var greater_than_today = dayDiff($(today_selector).val(),$(begin_selector).val());
		if(greater_than_today <= 1){
			$(begin_selector).val('');
			return 'today_error';
		}
	}


	return 'no_value';
}

function logout(){
	if(confirm('Est\u00E1 seguro que desea salir del sistema?')){
		location.href = document_root + 'index';
	}
}


function html_entity_decode (string, quote_style) {
    // Convert all HTML entities to their applicable characters
    //
    // version: 1102.614
    // discuss at: http://phpjs.org/functions/html_entity_decode
    // +   original by: john (http://www.jd-tech.net)
    // +      input by: ger
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: marc andreu
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +      input by: Ratheous
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Nick Kolosov (http://sammy.ru)
    // +   bugfixed by: Fox
    // -    depends on: get_html_translation_table
    // *     example 1: html_entity_decode('Kevin &amp; van Zonneveld');
    // *     returns 1: 'Kevin & van Zonneveld'
    // *     example 2: html_entity_decode('&amp;lt;');
    // *     returns 2: '&lt;'
    var hash_map = {},
        symbol = '',
        tmp_str = '',
        entity = '';
    tmp_str = string.toString();

    if (false === (hash_map = this.get_html_translation_table('HTML_ENTITIES', quote_style))) {
        return false;
    }

    // fix &amp; problem
    // http://phpjs.org/functions/get_html_translation_table:416#comment_97660
    delete(hash_map['&']);
    hash_map['&'] = '&amp;';

    for (symbol in hash_map) {
        entity = hash_map[symbol];
        tmp_str = tmp_str.split(entity).join(symbol);
    }
    tmp_str = tmp_str.split('&#039;').join("'");

    return tmp_str;
}

function get_html_translation_table (table, quote_style) {
    // Returns the internal translation table used by htmlspecialchars and htmlentities
    //
    // version: 1102.614
    // discuss at: http://phpjs.org/functions/get_html_translation_table
    // +   original by: Philip Peterson
    // +    revised by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: noname
    // +   bugfixed by: Alex
    // +   bugfixed by: Marco
    // +   bugfixed by: madipta
    // +   improved by: KELAN
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
    // +      input by: Frank Forte
    // +   bugfixed by: T.Wild
    // +      input by: Ratheous
    // %          note: It has been decided that we're not going to add global
    // %          note: dependencies to php.js, meaning the constants are not
    // %          note: real constants, but strings instead. Integers are also supported if someone
    // %          note: chooses to create the constants themselves.
    // *     example 1: get_html_translation_table('HTML_SPECIALCHARS');
    // *     returns 1: {'"': '&quot;', '&': '&amp;', '<': '&lt;', '>': '&gt;'}
    var entities = {},
        hash_map = {},
        decimal = 0,
        symbol = '';
    var constMappingTable = {},
        constMappingQuoteStyle = {};
    var useTable = {},
        useQuoteStyle = {};

    // Translate arguments
    constMappingTable[0] = 'HTML_SPECIALCHARS';
    constMappingTable[1] = 'HTML_ENTITIES';
    constMappingQuoteStyle[0] = 'ENT_NOQUOTES';
    constMappingQuoteStyle[2] = 'ENT_COMPAT';
    constMappingQuoteStyle[3] = 'ENT_QUOTES';

    useTable = !isNaN(table) ? constMappingTable[table] : table ? table.toUpperCase() : 'HTML_SPECIALCHARS';
    useQuoteStyle = !isNaN(quote_style) ? constMappingQuoteStyle[quote_style] : quote_style ? quote_style.toUpperCase() : 'ENT_COMPAT';

    if (useTable !== 'HTML_SPECIALCHARS' && useTable !== 'HTML_ENTITIES') {
        throw new Error("Table: " + useTable + ' not supported');
        // return false;
    }

    entities['38'] = '&amp;';
    if (useTable === 'HTML_ENTITIES') {
        entities['160'] = '&nbsp;';
        entities['161'] = '&iexcl;';
        entities['162'] = '&cent;';
        entities['163'] = '&pound;';
        entities['164'] = '&curren;';
        entities['165'] = '&yen;';
        entities['166'] = '&brvbar;';
        entities['167'] = '&sect;';
        entities['168'] = '&uml;';
        entities['169'] = '&copy;';
        entities['170'] = '&ordf;';
        entities['171'] = '&laquo;';
        entities['172'] = '&not;';
        entities['173'] = '&shy;';
        entities['174'] = '&reg;';
        entities['175'] = '&macr;';
        entities['176'] = '&deg;';
        entities['177'] = '&plusmn;';
        entities['178'] = '&sup2;';
        entities['179'] = '&sup3;';
        entities['180'] = '&acute;';
        entities['181'] = '&micro;';
        entities['182'] = '&para;';
        entities['183'] = '&middot;';
        entities['184'] = '&cedil;';
        entities['185'] = '&sup1;';
        entities['186'] = '&ordm;';
        entities['187'] = '&raquo;';
        entities['188'] = '&frac14;';
        entities['189'] = '&frac12;';
        entities['190'] = '&frac34;';
        entities['191'] = '&iquest;';
        entities['192'] = '&Agrave;';
        entities['193'] = '&Aacute;';
        entities['194'] = '&Acirc;';
        entities['195'] = '&Atilde;';
        entities['196'] = '&Auml;';
        entities['197'] = '&Aring;';
        entities['198'] = '&AElig;';
        entities['199'] = '&Ccedil;';
        entities['200'] = '&Egrave;';
        entities['201'] = '&Eacute;';
        entities['202'] = '&Ecirc;';
        entities['203'] = '&Euml;';
        entities['204'] = '&Igrave;';
        entities['205'] = '&Iacute;';
        entities['206'] = '&Icirc;';
        entities['207'] = '&Iuml;';
        entities['208'] = '&ETH;';
        entities['209'] = '&Ntilde;';
        entities['210'] = '&Ograve;';
        entities['211'] = '&Oacute;';
        entities['212'] = '&Ocirc;';
        entities['213'] = '&Otilde;';
        entities['214'] = '&Ouml;';
        entities['215'] = '&times;';
        entities['216'] = '&Oslash;';
        entities['217'] = '&Ugrave;';
        entities['218'] = '&Uacute;';
        entities['219'] = '&Ucirc;';
        entities['220'] = '&Uuml;';
        entities['221'] = '&Yacute;';
        entities['222'] = '&THORN;';
        entities['223'] = '&szlig;';
        entities['224'] = '&agrave;';
        entities['225'] = '&aacute;';
        entities['226'] = '&acirc;';
        entities['227'] = '&atilde;';
        entities['228'] = '&auml;';
        entities['229'] = '&aring;';
        entities['230'] = '&aelig;';
        entities['231'] = '&ccedil;';
        entities['232'] = '&egrave;';
        entities['233'] = '&eacute;';
        entities['234'] = '&ecirc;';
        entities['235'] = '&euml;';
        entities['236'] = '&igrave;';
        entities['237'] = '&iacute;';
        entities['238'] = '&icirc;';
        entities['239'] = '&iuml;';
        entities['240'] = '&eth;';
        entities['241'] = '&ntilde;';
        entities['242'] = '&ograve;';
        entities['243'] = '&oacute;';
        entities['244'] = '&ocirc;';
        entities['245'] = '&otilde;';
        entities['246'] = '&ouml;';
        entities['247'] = '&divide;';
        entities['248'] = '&oslash;';
        entities['249'] = '&ugrave;';
        entities['250'] = '&uacute;';
        entities['251'] = '&ucirc;';
        entities['252'] = '&uuml;';
        entities['253'] = '&yacute;';
        entities['254'] = '&thorn;';
        entities['255'] = '&yuml;';
    }

    if (useQuoteStyle !== 'ENT_NOQUOTES') {
        entities['34'] = '&quot;';
    }
    if (useQuoteStyle === 'ENT_QUOTES') {
        entities['39'] = '&#39;';
    }
    entities['60'] = '&lt;';
    entities['62'] = '&gt;';


    // ascii decimals to real symbols
    for (decimal in entities) {
        symbol = String.fromCharCode(decimal);
        hash_map[symbol] = entities[decimal];
    }

    return hash_map;
}

function str_replace (search, replace, subject, count) {
    // Replaces all occurrences of search in haystack with replace
    //
    // version: 1107.2516
    // discuss at: http://phpjs.org/functions/str_replace    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   improved by: Gabriel Paderni
    // +   improved by: Philip Peterson
    // +   improved by: Simon Willison (http://simonwillison.net)
    // +    revised by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)    // +   bugfixed by: Anton Ongson
    // +      input by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    tweaked by: Onno Marsman
    // +      input by: Brett Zamir (http://brett-zamir.me)    // +   bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   input by: Oleg Eremeev
    // +   improved by: Brett Zamir (http://brett-zamir.me)
    // +   bugfixed by: Oleg Eremeev
    // %          note 1: The count parameter must be passed as a string in order    // %          note 1:  to find a global variable in which the result will be given
    // *     example 1: str_replace(' ', '.', 'Kevin van Zonneveld');
    // *     returns 1: 'Kevin.van.Zonneveld'
    // *     example 2: str_replace(['{name}', 'l'], ['hello', 'm'], '{name}, lars');
    // *     returns 2: 'hemmo, mars'    var i = 0,
        j = 0,
        temp = '',
        repl = '',
        sl = 0,        fl = 0,
        f = [].concat(search),
        r = [].concat(replace),
        s = subject,
        ra = Object.prototype.toString.call(r) === '[object Array]',        sa = Object.prototype.toString.call(s) === '[object Array]';
    s = [].concat(s);
    if (count) {
        this.window[count] = 0;
    }
    for (i = 0, sl = s.length; i < sl; i++) {
        if (s[i] === '') {
            continue;
        }        for (j = 0, fl = f.length; j < fl; j++) {
            temp = s[i] + '';
            repl = ra ? (r[j] !== undefined ? r[j] : '') : r[0];
            s[i] = (temp).split(f[j]).join(repl);
            if (count && s[i] !== temp) {                this.window[count] += (temp.length - s[i].length) / f[j].length;
            }
        }
    }
    return sa ? s : s[0];}

//RETURNS AN ARRAY OF YEARS, SINCE THE SYSTEM STARTED TILL ITS DURATION
function getGlobalYears(){
	var i = 0, global_years = [];
	for(i = 0; i < parseInt($("#hdnDurationSystem").val()); i++){
		global_years[i] = parseInt($("#hdnStartSystemYear").val()) + i;
	}
	return global_years;
}



//GLOBAL VARIABLE FOR CHOOSING THE MONTH AND YEAR ON THE SCROLLER TOOL
function getMonthsForScroller(global_years){
	var  global_wheels = [], i = 0;

	global_wheels[0] = { 'Mes': {} };
		global_wheels[0]['Mes']['ENERO'] = 'ENERO';
		global_wheels[0]['Mes']['FEBRERO'] = 'FEBRERO';
		global_wheels[0]['Mes']['MARZO'] = 'MARZO';
		global_wheels[0]['Mes']['ABRIL'] = 'ABRIL';
		global_wheels[0]['Mes']['MAYO'] = 'MAYO';
		global_wheels[0]['Mes']['JUNIO'] = 'JUNIO';
		global_wheels[0]['Mes']['JULIO'] = 'JULIO';
		global_wheels[0]['Mes']['AGOSTO'] = 'AGOSTO';
		global_wheels[0]['Mes']['SEPTIEMBRE'] = 'SEPTIEMBRE';
		global_wheels[0]['Mes']['OCTUBRE'] = 'OCTUBRE';
		global_wheels[0]['Mes']['NOVIEMBRE'] = 'NOVIEMBRE';
		global_wheels[0]['Mes']['DICIEMBRE'] = 'DICIEMBRE';
	global_wheels[1] = { 'A&ntilde;o': {} };	
		for(i = 0; i < global_years.length ; i++){
			global_wheels[1]['A&ntilde;o'][global_years[i]] = global_years[i];
		}
	return global_wheels;
}