document.addEventListener('DOMContentLoaded', function() {
    const lookupButton = document.getElementById('lookup');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function() {
        let country = document.getElementById('country').value;
        fetch(`http://localhost:8080/info2180-lab5/world.php?name=${country}`)
            .then((response) =>{
                if(response.ok){
                    return response.text();
                }else{
                    return Promise.reject("An error has occured");
                }
            })
            .then((data) =>{
                resultDiv.innerHTML = data;
            })
            .catch((error)=>{
                console.log(error);
                
            })       
    });
});
