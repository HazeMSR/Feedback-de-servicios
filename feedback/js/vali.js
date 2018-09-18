$('#formIns').validetta({
regExp: {
regname : {
pattern : [^([1|2]{1})([9|0]{1})([0-9]{1})([0-9]{1})([\-]{1})([0|1]{1})([0-9]{1})([0-3]{1})([0-9]{1})+$]
errorMessage : 'Debe seguir con el patron AAAA-MM-DD'
}
}
});