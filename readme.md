# Instructions

## How to install

##### 1) Clone git repository:
`git clone git@github.com:zergbz1988/test-api.git test-api`

##### 2) Jump to project folder:
`cd test-api`

##### 3) Install composer dependencies:
`composer install`

##### 4) Apply migrations:
`php artisan migrate --seed`

##### 5) Setup Laravel Passport:
`php artisan passport:install`

##### 6) Run Tests:
For Windows:
`vendor\bin\phpunit.bat`

For Linux:
`./vendor/bin/phpunit`

***To run all test maybe you'll have to set mysql setting 'max_connections' to 50-100***

## How to use

##### 0) register new user:

```
php artisan user:register
```

***You'll have to enter user name, email and password to register new user.***

##### 1) get all categories:
`curl -X GET test-api/api/categories`

Response:
```
{
"status": "ok",
"categories":[
{
"id": 1,
"name": "2cvpVbVGjy",
"created_at": "2018-09-15 20:08:48",
"updated_at": "2018-09-15 20:08:48"
},
{
"id": 2,
"name": "VIDvM8k2b8",
"created_at": "2018-09-15 20:08:48",
"updated_at": "2018-09-15 20:08:48"
}
]
}
```

##### 2) get products by category:
`curl -X GET test-api/api/categories/1/products`

Response:
```
{
"status": "ok",
"id": 1,
"products":[
{
"id": 1,
"name": "Test 11q",
"price": 200,
"created_at": "2018-09-15 20:08:48",
"updated_at": "2018-09-15 20:09:08"
},
{
"id": 3,
"name": "IBvXPSyyIS",
"price": 75,
"created_at": "2018-09-15 20:08:48",
"updated_at": "2018-09-15 20:08:48"
},
{
"id": 4,
"name": "Test 0.09847300 1537042151",
"price": 300,
"created_at": "2018-09-15 20:09:11",
"updated_at": "2018-09-15 20:09:11"
},
{
"id": 5,
"name": "Test 0.31438700 1537042151",
"price": 300,
"created_at": "2018-09-15 20:09:11",
"updated_at": "2018-09-15 20:09:11"
}
]
}
```

##### 3) login:

`curl -H "Content-Type: application/x-www-form-urlencoded" -X POST test-api/api/login -d "email=test%40test.com&password=12345"` 

Response:
```
{
"status":"ok",
"accessToken":"eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3
OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxOD
Q1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4
NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xy
lmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeia
jyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6Nmu
FH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7
xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSq
kbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q",
"tokenType":"Bearer",
"expiresAt":"2019-09-15 21:26:22"
}
```

Then use **accessToken** for other methods.

##### 4) logout:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X POST test-api/api/logout`

Response:
```
{
"status": "ok"
}
```

##### 5) Put new product:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X PUT test-api/api/products -d "name=%D0%92%D0%B0%D1%81%D1%8F3&price=200&categories%5B0%5D=1&categories%5B1%5D=2"`

Response:
```
{
"status": "ok",
"id": 7
}
```

##### 6) Edit product:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X PATCH test-api/api/products/7 -d "name=%D0%92%D0%B0%D1%81%D1%8F3&price=200&categories%5B0%5D=1&categories%5B1%5D=2"`

Response:
```
{
"status": "ok",
"id": 7
}
```

##### 7) Delete product:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X DELETE test-api/api/products/7`

Response:
```
{
"status": "ok",
}
```

##### 8) Put new category:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X PUT test-api/api/categories -d "name=%D0%92%D0%B0%D1%81%D1%8F3"`

Response:
```
{
"status": "ok",
"id": 5
}
```

##### 9) Edit category:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X PATCH test-api/api/categories/5 -d "name=%D0%92%D0%B0%D1%81%D1%8F3"`

Response:
```
{
"status": "ok",
"id": 5
}
```

##### 10) Delete category:

`curl -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjMzNTdmZjgxYTQxMTZkYjMwMTY1ODE4YzE1YWU4MTg0NTQyNTU3OTM5MTQ5MDYzYjA1ZTVmZTg2MDQ3ZTk5ZTVjMzBlY2E5NjhhY2RhMDI3In0.eyJhdWQiOiIxIiwianRpIjoiMzM1N2ZmODFhNDExNmRiMzAxNjU4MThjMTVhZTgxODQ1NDI1NTc5MzkxNDkwNjNiMDVlNWZlODYwNDdlOTllNWMzMGVjYTk2OGFjZGEwMjciLCJpYXQiOjE1MzcwNDY3ODIsIm5iZiI6MTUzNzA0Njc4MiwiZXhwIjoxNTY4NTgyNzgyLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Q6s7NGEDctKdxELD5ms18RnFrSTzNTfNmYa7Vq5Uny9itNMv_cscANwJrE7izZgjIhwNs8tzbl5ofJzINNe4Xylmv2ratvbHqC4va7FWOEDiUJXR01t7V8cP1YFoaZxcgHdsuzy42svqYgu4Ead411wK_UI4pHvKBGJf0cY9xVTXPBTKyC6wLEm0rXZXwEZsyKfzAE0RmzTBDGWpOeiajyl2iYhfzj9NJyxNOqplGrxma8hPtb32aZKROkBQIbWVu2Q10W_tUQIbvvc-2NCggRyzW2QXonbyqxncsOpWPMbfnDpoo50v_91mgr58vc1Dxmqjvw_7mgeZhl6NmuFH4DOh94nxDQnkEquQz-AphGdSasljjwFVe_Tu-RhfPgld9FiqxUD_qhl4F_3vZZf2ejeYVO6AwyWQrQriLYwmwsyeGGil4fMecIF5kFUw7LOG9VCDvfBUHuQ8u1Z7xl77zT59GWeerjB5bdqw8MsKvVcZ3RHZHXy2oZIbR_IKKR_UT1hro-tNkymTRx2Qer5eYwKlegrY3RjJaVAGxrESv2-b1Xc9qTf0dr5Jb4HEZ1JJ5QIH3z5kURCxSqkbJ8BlniUnpkHCJgkBbIZ4By38cib4RwgEFrsHVO_1PhrN_bauC38ROPdQDA_td8Aunu6fFmMG-oScXQs1fMolVzXKf3Q" -X DELETE test-api/api/categories/5`

Response:
```
{
"status": "ok",
}
```