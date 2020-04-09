class KReactInput extends  React.Component 
{
    constructor(props)
    {
        super(props);

        this.idOfTheInput = this.props.id+"_input";
        this.idOfTheLabel = this.props.id+"_label";
        const className = this.props.className || "";
        const inputType = this.props.type;
        const labelText = this.props.labelText;

    

        this.labelProperties = {htmlFor:this.idOfTheInput ,
                                id:this.idOfTheLabel ,
                                children:labelText,
                                key:this.idOfTheLabel ,
                                name:this.props.name || ""
                                };

        this.inputElementProperties  = {type:inputType,
                                        className:className ,
                                        id:this.idOfTheInput ,
                                        key:this.idOfTheInput,
                                        onChange : this.onChangeProcedure.bind(this) ,
                                        name:this.props.name || "" }

    }


    onChangeProcedure(event)
    {
        const htmlInputTag = event.target;;
        console.log("executing input change procedure "+ this.idOfTheInput);

        const defaultFn = ()=>console.log("doing procedure but its empty");
        const givenProcedure = this.props.onChange || defaultFn;

        givenProcedure(event)
    }

    render()
    {
      
        const _label = React.createElement("label",this.labelProperties);
        const _input = React.createElement("input",this.inputElementProperties);
        let kids = [];

        const labelText = this.props.labelText;

        if(labelText)
            kids.push(_label);
        kids.push(_input);

        let holder = React.createElement("div",{className:"form-group"},kids);

        return holder;


    }

}