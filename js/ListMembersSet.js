class ListMembersSet extends  React.Component 
{
    constructor(props)
    {
        super(props);
        this.state = { };
        this.state.listId = props.listId||999;
        this.noListSelectedText = props.noListSelectedText||"Please select a list";
        this.addFormElement = React.createRef();
    }


    noListSelected()
    {
        return this.state.listId == 999;
    }
    componentDidMount() 
    {
      fetch(this.props.findURL)
        .then(response => response.json())
        .then(memberLists => {
          let map = {};
          memberLists = memberLists;
          
          memberLists.forEach(element=>map[element.id] = element );
          
          this.setState({memberLists:memberLists, map:map});
      
      });
    }


    componentDidUpdate(prevProps) {        
        if(this.props.findURL===prevProps.findURL) return;
        this.state.listId = this.props.listId||999;
        fetch(this.props.findURL)
        .then(response => response.json())
        .then(this.updateMemberList.bind(this));
    }


    updateMemberList(memberLists)
    {
        let map = {};
        memberLists = memberLists;          
        memberLists.forEach(element=>map[element.id] = element );        
        this.setState({memberLists:memberLists, map:map});
    }


    addToList(event)
    {
          
        const elementClickedOn = event.target;

        console.log(this.state);
        console.log(this.props);
        console.log(this.addFormElement.current.state);

        const newMember = this.addFormElement.current.state;
   
        fetch(this.props.addURL,{
            method: 'POST',
            body: JSON.stringify(newMember),
            headers: {  'Content-Type': 'application/json'  }
        })
        .then(response => response.json())
        .then(this.updateMemberList.bind(this))        
        .then(this.render.bind(this))
        .catch(console.error);
    }

    removeFromList(event)
    {
        console.log(this);

        
        const elementClickedOn = event.target;
        const id = elementClickedOn.getAttribute("data-member-id");
        let chosenMember = this.state.map[id];
        fetch(this.props.removeURL,{
            method: 'POST',
            body: JSON.stringify(chosenMember),
            headers: {  'Content-Type': 'application/json'  }
        })
        .then(response => response.json())
        .then(this.updateMemberList.bind(this))        
        .then(this.render.bind(this))
        .catch(console.error);
         console.log(chosenMember);
        console.log(event.target);
    }

    render()
    {
        if(!this.state.memberLists)  return "<div>none</div>";

        const noListSelected = this.noListSelected();

      //  console.log(this.props);
        console.log("rendering members for list:"+this.state.listId);
        const headerRowCells = [ React.createElement("th",{children:"subscriber id",key:"001"}),
                                 React.createElement("th",{children:"membership id",key:"002"}), 
                                 React.createElement("th",{children:"name",key:"003"}), 
                                 React.createElement("th",{children:"email",key:"004"}), 
                                 React.createElement("th",{children:"added by",key:"005"})
                                ];
        const headerRow = React.createElement("tr",{key:"rH"},headerRowCells)
        const tHead = React.createElement("thead",{key:"head"},headerRow);

        let rowCells = [];
        const rows = [];
        let key = "";
        this.state.memberLists.forEach(member=>{
            key = member.id;
            let deleteBtn = e("div",{className:"btn btn-danger btn-sm","data-member-id":key,children:'remove', onClick:this.removeFromList.bind(this)});
            rowCells.push(React.createElement("td",{children:member.id,key:key+"01"}));
            rowCells.push(React.createElement("td",{children:member.membershipId,key:key+"02"}));
            rowCells.push(React.createElement("td",{children:member.name,key:key+"03"}));
            rowCells.push(React.createElement("td",{children:member.email,key:key+"04"}));
            rowCells.push(React.createElement("td",{children:member.addedBy,key:key+"05"}));

            if(!noListSelected)
              rowCells.push(React.createElement("td",{key:key+"_delBtn"},deleteBtn));

            rows.push( React.createElement("tr",{key:key},rowCells));

            rowCells = [];
                });
       

        const tbody = React.createElement("tbody",{key:"l_body"},rows);                                            
        const tbls = React.createElement("table",{"className":"table table-striped",key:"tbls"},[tHead,tbody]);
       
        const result = [];
        const addMemberForm = e(AddMemberForm,{id:"addMemberForm",key:"addForm",listId: this.state.listId, ref:this.addFormElement ,onSubmit:this.addToList.bind(this)});
    
        result[0] = noListSelected ? React.createElement("div",{children:this.noListSelectedText,key:"addForm"}):addMemberForm;
        result[1] = tbls;
        return result;

        
    }



}