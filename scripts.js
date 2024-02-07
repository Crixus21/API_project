function delPerson () 
{
    let delEmail = document.getElementById('delEmail').value;
    
    let xhr = new XMLHttpRequest();
    
    xhr.onload = function () {
        document.getElementById('result').innerHTML = this.responseText;
        document.getElementById('delEmail').value = '';
    };
    
    xhr.open('DELETE', 'index.php/people', true);
    xhr.setRequestHeader('Content-type', 'application/json; charset=UTF-8');
    xhr.send(delEmail);
}

function numSum() 
{
    let number = document.getElementById('number').value;
    let sum = 0;
    
    for(let n of number)
    {
        sum += parseInt(n);
    }
    
    document.getElementById('sumResult').innerHTML = 'Eredmény: ' + sum;
}

function calcPie ()
{
    let calcNum = 1;
    let parity = 1;
    
    
    for(let i = 3; i < 10000; i = i + 2)
    {
        if(parity % 2 === 0)
        {
            calcNum += 1 / i;
        }
        else
        {
            calcNum -= 1 / i;
        }
        parity++;
    }
    
    document.getElementById('pieResult').innerHTML = calcNum * 4;
}