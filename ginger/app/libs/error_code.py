#400 参数错误 401 未授权 403 禁止访问 404 找不到页面或资源
#500 服务器未知错误
#200 查询成功 201 创建成功 204删除成功
#301 重定向
from app.libs.error import APIException


class ClientTypeError(APIException):
    code = 400
    msg = 'client type is invalid'
    error_code = 1006


class ParameterException(APIException):
    code = 400
    msg = 'invalid parameter'
    error_code = 1000