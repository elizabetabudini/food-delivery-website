$('#time').timepicker({
    'disableTimeRanges': [
      ['7pm', '8pm'],
      ['8pm', '9pm'],
      ['10pm', '11pm'],
      ['0am', '1am'],
      ['1am', '2am'],
      ['2am', '3am'],
      ['3am', '4am'],
      ['4am', '4am'],
      ['5am', '6am'],
      ['6am', '7am'],
      ['7am', '8am'],

    ]
});
$('#time').timepicker({ 'step': 10 });
$('#time').timepicker('option', { 'minTime': new Date(), 'maxTime': "7pm" });

$('#time').on('click', function (){
    $('#time').timepicker('show');
    $('#time').timepicker('setTime', new Date());
});
