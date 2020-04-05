

function selfAddTestController()
{

        function deleteByMemberId(memberId)
        {

            var listOfsubscribersTemplate = this;

          var memeberToDelete =    listOfsubscribersTemplate.dataHash[memberId];

          //removeFromList

          kLib.APIMainCourrier.post("?context=Subscriber&requestAction=removeFromList",memeberToDelete).then(function(response)
          {
                var itsAnError =   response.data._class === "models\\KError"
                if(itsAnError)
                    {    console.error(response.data);
                        throw response.data
                    }

                    listOfsubscribersTemplate.data = response.data;
                    listOfsubscribersTemplate.render();
                
            console.log(memeberToDelete);
            // alert(JSON.stringify(memeberToDelete))
          });
        }

           var test1_id = "test1";

            var  formToAdd = kLib.initForm({id:test1_id
                                        ,submitBtnId:"submitBtn_MailingList"
                                        ,courrierTool:kLib.APIMainCourrier});

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

        listOfsubscribersTemplate.onFetch (function(callback)
        {   var me = this;
            kLib.APIMainCourrier.get("?context=MailingList&requestAction=findAll")
            .then(function(response)
            {
                var selectTag = document.getElementById("selectTag");
                var lists = response.data;
                console.log(lists);
                var options= "<option>N/A</option>";
                kLib.forEach(lists,function(list){
                
                    options+=  "<option value='"+list.id+"' >"+list.name+"</option>";
                });
                selectTag.innerHTML = options;
                selectTag.onchange = function(e)
                {


                    var chosenListId = e.target.value;
                    kLib.setElementContentByClassName("list-id-holder",chosenListId);
                    kLib.activeForms.test1.setFormData("listToAddId",chosenListId);
                    kLib.APIMainCourrier.get("?context=Subscriber&requestAction=getSubscribersInList&list_id="+chosenListId)
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


                    /////////
                };
                console.log(me);
            });
        });


        listOfsubscribersTemplate.onRender(function()
        {
            var me = this;
            var data =me.data;
            me.delete = deleteByMemberId;
            var holder = document.getElementById(me.id);
            var tbl   =  document.createElement("table");
            tbl.className = "table table-striped";


            tbl.tHead =tbl.tHead|| document.createElement("thead");
            tbl.tHead.innerHTML =  "<tr>"
                    +"<th>subscriber id</th>"
                    +"<th>membership id</th>"
                    +"<th>name</th>"
                    +"<th>email</th>"
                    +"<th>added by</th>"
                +"</tr>"; 

            var tbody =  tbl.tBody || document.createElement("tbody");
      
            data.forEach(element =>
            {
                me.dataHash[element.membershipId] = element;
                var deleteButton = document.createElement("span");
                deleteButton.innerText = "delete";
                deleteButton.className="btn btn-danger";
                deleteButton.addEventListener("click", (e)=> me.delete(element.membershipId));
              

                var row = document.createElement("tr");
                var td = document.createElement("td");
                td.innerHTML = element.id
                row.appendChild(td);
                
                td = td.cloneNode();
                td.innerText = element.membershipId;
                row.appendChild(td);

                td = td.cloneNode();
                td.innerText = element.name;
                row.appendChild(td);

                td = td.cloneNode();
                td.innerText = element.email;
                row.appendChild(td);

                td = td.cloneNode();
                td.innerText = element.addedBy;
                row.appendChild(td);

                
                td = td.cloneNode();
                td.appendChild(deleteButton);
                row.appendChild(td);

                tbody.appendChild(row);
            });


            tbl.appendChild(tbody)


            holder.innerHTML = "";
            holder.appendChild(tbl)
            console.log(this);
        });

        listOfsubscribersTemplate.fetch();
}