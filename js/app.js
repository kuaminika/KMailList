

const e = React.createElement;
const ul = document.getElementById("mailingListHolder");
const ListMembersSet_properties = {findURL:"API/index.php?context=Subscriber&requestAction=findAll",
                                   findPerList:"",
                                   removeURL:"API/index.php?context=Subscriber&requestAction=removeFromList",
                                   addURL:"API/index.php?context=Subscriber&requestAction=addSubscriberToList",
                                   bestPersonEver:"Hersha duh!!"};


const memberList = e(ListMembersSet,ListMembersSet_properties);
ReactDOM.render(memberList,  document.getElementById("memberListHolder") );
ReactDOM.render(e(MailingListSet,{},{memberList:memberList}),ul  );


