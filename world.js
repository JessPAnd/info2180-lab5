document.addEventListener('DOMContentLoaded', function() {
    const lookupButton = document.getElementById('lookup');
    const lookupButton2 = document.getElementById('lookup2');
    const resultDiv = document.getElementById('result');

    lookupButton.addEventListener('click', function() {
        let country = document.getElementById('country').value;
        fetch(`http://localhost:8080/info2180-lab5/world.php?country=${country}`)
        .then((response)=>{
            if(response.ok){
                return response.text();
            }
            else
            {
                return Promise.reject(Error);
            }
        })
            .then((data) =>{
                resultDiv.innerHTML = data;
            })
            .catch((error)=>{
                console.log(error);
                
            })       
    });

    lookupButton2.addEventListener('click', function() {
        let country = document.getElementById('country').value;
        fetch(`http://localhost:8080/info2180-lab5/world.php?country=${country}&lookup=cities`)
        .then((response)=>{
            if (response.ok){
                return response.text();
            }
            else
            {
                return Promise.reject(Error);
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
