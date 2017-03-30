this module is designed to perform following requirement
1) Module should be intregate in another project
2) User can login wilt facebook, google as well as from our syatem too

What actually this module do?
if user register from out system, then it add email,password,and other user related information in users table
->when user login from facebook and google then it will save token in our system and we can retrive user informatin from that token,

Problem: User token may expire, if so then we cannot figure out which user perform certain task in our system

Solution 1: We can ask for password after user register from facebook and google, for our system and add this user information with email and password in our user table, in this case user need to type password two time, i dont think this is better solution.

Solution 2: We can make seperate table for keeping user information those who regisert with facebook and google and update token if expire, if they have already signup to our system 

I think second solution is good what do you think

//this is git branch testing