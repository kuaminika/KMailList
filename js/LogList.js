class LogList extends React.Component
{
    constructor(props)
    {
        super(props);
        this.state = { logItems:[]};
    }


    componentDidMount() 
    {
      fetch(this.props.findURL)
        .then(response => response.json())
        .then(logItems => {
          let map = {};
          
         logItems.forEach(element=>map[element.id] = element );
          
          this.setState({logItems:logItems, map:map});
      
      });
    }


    render()
    {
        let rows = [];
        this.state.logItems.forEach(item=>{
            let rowInfo =e("small",{children:item.LOG_DATE,className:" "});
            let rowDetail =e("div",{children:item.LOG_CONTENT,className:" "});
            let rowItem =e("div",{className:" list-group-item align-items-start"},[rowInfo,rowDetail]);
            rows.push(rowItem)

        });

        return rows;
    }
}