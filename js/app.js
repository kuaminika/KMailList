/*$.getJSON('js/mailingLists.json', function(data) {
console.log(data);



});/*/

const e = React.createElement;
const ul = document.getElementById("mailingListHolder");
//render(element, container, callback) 
//https://vps.cybereq.com/KuaminikaWorkspace/KMailList/API/index.php?context=Subscriber&requestAction=addSubscriberToList
//https://vps.cybereq.com/KuaminikaWorkspace/KMailList/API/index.php?context=Subscriber&requestAction=getSubscribersInList&list_id=4
const ListMembersSet_properties = {findURL:"API/index.php?context=Subscriber&requestAction=findAll",
                                   findPerList:"",
                                   removeURL:"API/index.php?context=Subscriber&requestAction=removeFromList",
                                   addURL:"API/index.php?context=Subscriber&requestAction=addSubscriberToList",
                                   bestPersonEver:"Hersha duh!!"};


const memberList = e(ListMembersSet,ListMembersSet_properties);
//const addMemberForm = e(AddMemberForm,{id:"addMemberForm"});
ReactDOM.render(memberList,  document.getElementById("memberListHolder") );
//ReactDOM.render(addMemberForm,  document.getElementById("formHolder") );
//AddMemberForm
ReactDOM.render(e(MailingListSet,{},{memberList:memberList}),ul  );


