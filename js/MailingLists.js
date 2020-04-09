"use strict";


class MailingListSet  extends React.Component {

    constructor(props) {
        super(props);
        this.state = { };
      }
      componentDidMount() 
      {
        fetch("API/index.php?context=MailingList&requestAction=findAll")
          .then(response => response.json())
          .then(mailingLists => {
            let map = {};
            mailingLists = mailingLists;
            
            mailingLists.forEach(element=>map[element.id] = element );
            
            this.setState({mailingLists:mailingLists, map:map});

            this.render();
        
        });
      }

      hihiIClicked(event)
      {

          const elementClickedOn = event.target;

          
          const id = elementClickedOn.getAttribute("data-list-id");
          
          const memberListProps = JSON.parse(JSON.stringify(this.props.children.memberList.props));
          kLib.validateOnlyThisElementHasClassName(elementClickedOn,"selected");
          memberListProps.findURL = "API/index.php?context=Subscriber&requestAction=getSubscribersInList&list_id="+id;
          memberListProps.listId = id;
          ReactDOM.render(e(ListMembersSet,memberListProps),  document.getElementById("memberListHolder") );        
      }

      render() 
      {


        let listEl=[];
        this.state.mailingLists = this.state.mailingLists ||[];
        this.state.mailingLists.forEach((ml)=>{


         listEl.push( e("li",{
                             "data-list-id" : ml.id,
                             className: 'list-group-item',
                             children:ml.name,
                             onClick :this.hihiIClicked.bind(this),
                             key :"list_id"+ml.id
          })); 
        });        

        const result = e("ul",{},listEl);
        return result;
      }


}