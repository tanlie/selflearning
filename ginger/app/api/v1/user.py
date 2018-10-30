from app.libs.redprint import Redprint




api = Redprint('user')


@api.route('/getUser')
def getUser():
    return 'hello python'