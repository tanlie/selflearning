from flask import Blueprint

test = Blueprint('test', __name__)
@test.route('/test')
def tanlie():
    return  'tanlie test'

