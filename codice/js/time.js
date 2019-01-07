$('#time').timepicker({
    'disableTimeRanges': [
      ['1am', '2am'],
      ['3am', '4am'],
      ['1am', '2am'],
      ['1am', '2am'],
      ['1am', '2am']

    ]
});
$('#time').timepicker({ 'step': 10 });
$('#time').timepicker('option', { 'minTime': new Date(), 'maxTime': "10pm" });

$('#time').on('click', function (){
    $('#time').timepicker('show');
    $('#time').timepicker('setTime', new Date());
});
