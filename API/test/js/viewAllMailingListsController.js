function viewAllMailingListsController()
{

    
    var list = kLib.initTemplate({id:"list"});



    list.onFetch (function(callback)
    {
        var me = this;
        kLib.APIMainCourrier.get("?context=MailingList&requestAction=findAll")
        .then(function(response)
        {       

            var itsAnError =   response.data._class === "models\\KError"
            if(itsAnError)
            {     console.error(response.data);
                    throw response.data.message;
                    }
            me.data = response.data;
            callback();
        });

    });//.bind(listOfsubscribersTemplate);


    list.onRender(function()
    {
        var data =this.data;
        var holder = document.getElementById(this.id);
      
        var reference = holder.firstElementChild;

        data.forEach(element => {
            
           var clone = reference.cloneNode(true);
           var ownerHolder =  clone.getElementsByClassName("owner-info-holder")[0];
           ownerHolder.innerHTML = element.owner.name+"-"+element.owner.email;

           var nameHolder =  clone.getElementsByClassName("name-holder")[0];
           nameHolder.innerHTML = element.name;
           
           var memberCountHolder =  clone.getElementsByClassName("member-count-holder")[0];
           memberCountHolder.innerHTML = element.memberCount;



           holder.appendChild(clone);
        });
        holder.removeChild(reference);

    });

    list.fetch();
 }