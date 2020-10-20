
const appProperties  = {
    logListHolderId :"logListHolder",
    mailingListHolderId: "mailingListHolder",
    mainFloorId:"mainFloor",
    dashBoardBtnId:"DashboardBtn",
    LogsBtnId:"LogsBtn",
    dashboardId:"Dashboard"
}
const ListMembersSet_properties = {findURL:"API/index.php?context=Subscriber&requestAction=findAll",
                                   findPerList:"",
                                   removeURL:"API/index.php?context=Subscriber&requestAction=removeFromList",
                                   addURL:"API/index.php?context=Subscriber&requestAction=addSubscriberToList",
                                   bestPersonEver:"Hersha duh!!"};


const e = React.createElement;
const logListHolder = document.getElementById(appProperties.logListHolderId);
const ul = document.getElementById(appProperties.mailingListHolderId);
const mainFloor = document.getElementById(appProperties.mainFloorId);
const dashBoard = document.getElementById(appProperties.dashboardId);
const LogList_properties = {findURL:"SETUP/API?context=ShowLog"}
const memberList = e(ListMembersSet,ListMembersSet_properties);
const logList = e(LogList,LogList_properties);
ReactDOM.render(memberList,  document.getElementById("memberListHolder") );
ReactDOM.render(e(MailingListSet,{},{memberList:memberList}),ul  );
ReactDOM.render(logList,logListHolder);


const appFns = {
    activateDash: function(){
        kLib.removeClassToAllWithClassName("k-menu","active");
        kLib.removeClassToAllWithClassName("k-component","d-flex");
        kLib.addClassToAllWithClassName("k-component","d-none");
        $(dashBoard).removeClass("d-none");
        $(dashBoard).addClass("d-flex");
    },
    activateLog: function(){
        kLib.removeClassToAllWithClassName("k-menu","active");
        kLib.removeClassToAllWithClassName("k-component","d-flex");
        kLib.addClassToAllWithClassName("k-component","d-none");
        $(logListHolder).removeClass("d-none");
        $(logListHolder).addClass("d-flex");
    }
}


$("#"+appProperties.dashBoardBtnId).click(appFns.activateDash);
$("#"+appProperties.LogsBtnId).click(appFns.activateLog);