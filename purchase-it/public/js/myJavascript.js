$(document).ready(function(){
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
    $(".message-box").fadeTo(4000, 500).slideUp(500, function(){
        $(".message-box").slideUp(500).remove();
    });

    
});

function openEditModal(id){
    $("#"+id).attr("href", "#editCustomerModal"+id);
}

