kLib.APIMainCourrier.hostURL = "https://vps.cybereq.com/KuaminikaWorkspace/KMailList/API/index.php";


var app = app||{};
kLib.mapTemplate("selfAddTestController","views/selfAddTest.html");
kLib.mapTemplate("viewAllMailingListsController","views/viewMailingLists.html");


function activateSection(btn)
{
    var controllerName = btn.getAttribute("data-controller");
    var controller = kLib.getController(controllerName);

    if(!controller.url)
    {   kLib.removeClassToAllWithClassName("nav-item ","active");
    kLib.addClasstoElement(btn.parentElement,"active");  
        kLib.removeClassToAllWithClassName("test-page","active");
        var section =  document.getElementById(controllerName);
        kLib.addClasstoElement(section,"active");
        section.innerHTML = "";
        return;
    }


    kLib.MainCourrier.get(controller.url).then( function(response)
    {
        kLib.removeClassToAllWithClassName("nav-item ","active");
        kLib.addClasstoElement(btn.parentElement,"active");  
        kLib.removeClassToAllWithClassName("test-page","active");
     
        var htmlView = response.data;
       var section =  document.getElementById(controllerName);
       kLib.addClasstoElement(section,"active");
        section.innerHTML = htmlView || "";
        controller.run()
        });

}

app[activateSection.name]= activateSection;