from flask import Blueprint

user = Blueprint('user',__name__)

@user.route('/v1/getUser')
def getUser():
    return 'hello python'