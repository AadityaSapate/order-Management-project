

1. client sends 'email' and 'password' ia POST request to server
2. server sends back {"token":"THETOKEN"} or status 401
3. client makes requests to protected endpoints with the header "Authorization: THETOKEN"
4. server either accepts the token or sends status 401 (then start again from 1.)


protected endpoints ->

 
1 add products -> enter product details

2 place order -> place new order

3 view orders placed -> shows all the  placed orders

4 view by filter -> shows all the placed orders filter by quantity 

5 Delete product 

6 update position

7 update price
