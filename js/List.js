"use strict";

const e = React.createElement;


class MailingListSet  extends React.Component {

    constructor(props) {
        super(props);
        this.state = { };
      }
    
      componentDidMount() {
        fetch("js/mailingLists.json")
          .then(response => response.json())
          .then(mailingLists => {
            this.setState({mailingLists:mailingLists});

            this.render();
              ///console.log(data)this.setState(
   /*
            const ul = document.getElementById("mailingListHolder");
              mailingLists.objArray.forEach(mailinglist => {
               ul.append( ReactDOM.render(e(
                'li',
                { "className": "list-group-item" },
                mailinglist.listName
              ))  )  
              
       
             
              });*/
        
        }
          /*this.setState({ hits: data.hits }
            )*/);
      }

      render() {
        if (this.state.mailingLists) {

            var all= "";

            this.state.mailingLists.objArray.forEach((ml)=>all+= "<li class='list-group-item'>"+ml.listName+"</li>");
            
            const ul = document.getElementById("mailingListHolder");
            ul.innerHTML = all;           
        }
    
        return e(
          'li',
          { "className": "list-group-item" },
         ""
        );
      }


}
const ul = document.getElementById("mailingListHolder");
//render(element, container, callback) 
ReactDOM.render(e(MailingListSet),ul  );

