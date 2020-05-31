

const e = React.createElement;
const logListHolder = document.getElementById("logListHolder");
const ul = document.getElementById("mailingListHolder");
const mainFloor = document.getElementById("mainFloor");
const ListMembersSet_properties = {findURL:"API/index.php?context=Subscriber&requestAction=findAll",
                                   findPerList:"",
                                   removeURL:"API/index.php?context=Subscriber&requestAction=removeFromList",
                                   addURL:"API/index.php?context=Subscriber&requestAction=addSubscriberToList",
                                   bestPersonEver:"Hersha duh!!"};

const LogList_properties = {findURL:"SETUP/API?context=ShowLog"}
const memberList = e(ListMembersSet,ListMembersSet_properties);
const logList = e(LogList,LogList_properties);
ReactDOM.render(memberList,  document.getElementById("memberListHolder") );
ReactDOM.render(e(MailingListSet,{},{memberList:memberList}),ul  );
ReactDOM.render(logList,logListHolder);


