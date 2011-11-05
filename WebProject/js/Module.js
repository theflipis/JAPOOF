var Module = Class.create({
    reload: function(moduleID, containerDivID, paramsJSON)
    {
        paramsJSON["RELOAD"] = true;
        var realData = $.param(paramsJSON);        
        $.ajax({
            url: "index.php",
            data: realData,
            type: "post",
            dataType: "html",
            beforeSend: function()
            {
                $("#"+containerDivID).html("LOADING MODULE...");
            },
            success: function(data)
            {
                $("#"+containerDivID).html(data);
            }
        });
    }
});