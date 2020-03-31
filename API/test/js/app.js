kLib.MainCourrier.hostURL = "https://vps.cybereq.com/KuaminikaWorkspace/KMailList/API/index.php";


var test1_id = "test1";

var  formToAdd = kLib.initForm({id:test1_id
                                    ,submitBtnId:"submitBtn_MailingList"
                                    ,courrierTool:kLib.MainCourrier});

  function whenClickedToAdd()
  {
        var me = this;
        me.sendInfo("?context=Subscriber&requestAction=addSubscriberToList",function(response){

            
        var itsAnError =   response.data._class === "models\\KError"
        if(itsAnError)
            {    console.error(response.data);
                throw response.data
            }

            listOfsubscribersTemplate.data = response.data;
            listOfsubscribersTemplate.render();
        });
  }
    
   formToAdd.setSubmitProcedure(whenClickedToAdd);




var listOfsubscribersTemplate = kLib.initTemplate({id:"listOfsubscribers"});

listOfsubscribersTemplate.fetchProcedure = (function(callback)
{
    var me = this;
    kLib.MainCourrier.get("?context=Subscriber&requestAction=getSubscribersInList&list_id=1")
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

}).bind(listOfsubscribersTemplate);

listOfsubscribersTemplate.render = (function()
{
    var data =this.data;
    var holder = document.getElementById(this.id);
    var tbl   =  document.createElement("table");
    tbl.className = "table table-striped";


    tbl.tHead =tbl.tHead|| document.createElement("thead");
    tbl.tHead.innerHTML =  "<tr>"
            +"<th>id</th>"
            +"<th>name</th>"
            +"<th>email</th>"
            +"<th>added by</th>"
        +"</tr>"; 

   var tbody =  tbl.tBody || document.createElement("tbody");
    var tbodyContentStr = "";
    data.forEach(element => {
        tbodyContentStr+=  "<tr>"
        +"<td>"+element.id+"</td>"
        +"<td>"+element.name+"</td>"
        +"<td>"+element.email+"</td>"
        +"<td>"+element.addedBy+"</td>"
    +"</tr>"
        console.log(tbodyContentStr);
    });


    tbody.innerHTML = tbodyContentStr;
    tbl.appendChild(tbody)


    holder.innerHTML = "";
        holder.appendChild(tbl)
    console.log(this);
}).bind(listOfsubscribersTemplate);

listOfsubscribersTemplate.fetch();