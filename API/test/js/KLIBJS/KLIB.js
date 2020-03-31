

(function()
{
    var w = window||this;
    function IsFunction(specimen)
    {
        var exists = specimen || false;
        var itsAfunction = toString.call(specimen||{}) === '[object Function]';
        return exists && itsAfunction ;
    }


    function showParam(data)
    {
        console.log(data);
    }

    function blnkProcedure()
    {
        console.log("this is a blank procedure. it should be replaced by an implementation")
    }

    
    function getById(_id)
    {
        var result = document.getElementById(_id);
        return result;
    }

	w.kLib =w.kLib || {};
    var kLib = w.kLib ;
    kLib.getById = getById;
    kLib.isFunction = IsFunction;
    kLib.blnkProcedure = blnkProcedure;
    w.kLib = kLib;
    
})()
