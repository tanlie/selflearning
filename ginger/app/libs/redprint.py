

class Redprint:
    def __init__(self,name):
        self.name = name
        self.mound = []

    def route(self, rule, **options):
        def decorator(f):
            self.mound.append((f,rule,options))
            return f
        return decorator


    def register(self,bp,url_pre_fix=None):
        for f, rule, options in self.mound:
            endpoint = options.pop("endpoint", f.__name__)
            bp.add_url_rule( url_pre_fix + rule, endpoint, f, **options)

        pass