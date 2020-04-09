
class AddMemberForm  extends React.Component 
{


    constructor(props)
    {
        super(props);
        this.state = { name:"N/A",email:"N/A", listToAddId:props.listId};
        this.nameInputElement = React.createRef();
        this.emailInputElement = React.createRef();

    }

    onSubmitProcedure(event)
    {
        console.log("executing form "+this.props.id+"submitcProcedure ");

        const defaultFn = ()=>console.log("doing procedure but its empty");
        const givenProcedure = this.props.onSubmit || defaultFn;

        givenProcedure(event);
    }


    onInputChanged(event)
    {
            
        const htmlInputTag = event.target;;
        this.state[htmlInputTag.name]  = htmlInputTag.value;
    }


    render()
    {
        console.log(this.props);
     

        const nameInput = React.createElement(KReactInput, {id:this.props.id+"Name" ,labelText:"Name", name:"name", onChange:this.onInputChanged.bind(this), type:"text" , ref:this.nameInputElement ,className:"form-control", key:"nameInput"});
        const emailInput = React.createElement(KReactInput,{id:this.props.id+"Email" ,labelText:"Email",name:"email",onChange:this.onInputChanged.bind(this), type:"email",ref:   this.emailInputElement, className:"form-control", key:"emailInput"});
        const btn = React.createElement("div",{className:"btn btn-success",children:"add",onClick:this.onSubmitProcedure.bind(this),key:"submitBtn"});
        const result =  React.createElement("form",{id:this.props.id},[nameInput,emailInput,btn]);
       return result;
    }

}