

    /* function popUp(display, DossierID)
    {
        if(display == "show")
        {
            $('.popup').css('display', 'flex');
        }
        else
        {
            $('.popup').css('display', 'none');
        }
        
    } */
    function popUp(display, action)
    {
        if(display == "show")
        {
            if(action == "DeleteAlert")
            {
                $('.DeleteAlert').css('display', 'flex');
            }
            else
            {
                $('.EditProfile').css('display', 'flex');
            }
            
        }
        else
        {
            if(action == "DeleteAlert")
            {

                $('.DeleteAlert').css('display', 'none');
            }
            else
            {
                $('.EditProfile').css('display', 'none');
            }
        }
        
        
        
    }
    
