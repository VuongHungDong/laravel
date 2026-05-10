import sys
import json
from datetime import datetime
from collections import defaultdict

def calculate_age(birthday_str):
    if not birthday_str:
        return None
    try:
        birth_date = datetime.strptime(birthday_str.split('T')[0], "%Y-%m-%d")
        today = datetime.today()
        age = today.year - birth_date.year - ((today.month, today.day) < (birth_date.month, birth_date.day))
        return age
    except Exception:
        return None

def get_age_group(age):
    if age is None:
        return "Unknown"
    if age < 18:
        return "<18"
    elif age <= 25:
        return "18-25"
    elif age <= 35:
        return "26-35"
    elif age <= 50:
        return "36-50"
    else:
        return ">50"

def main():
    try:
        # Read JSON from stdin
        input_data = sys.stdin.read()
        if not input_data:
            print(json.dumps({"error": "No input data"}))
            return
            
        data = json.loads(input_data)
        orders = data.get('orders', [])
        
        # Analytics containers
        # { 'male': {'Hoa Hồng': 5, 'Tulip': 2}, ... }
        gender_preferences = defaultdict(lambda: defaultdict(int))
        # { '18-25': {'Hoa Hồng': 5}, ... }
        age_preferences = defaultdict(lambda: defaultdict(int))
        
        total_revenue = 0
        
        for order in orders:
            user = order.get('user', {})
            gender = user.get('gender') or 'other'
            age = calculate_age(user.get('birthday'))
            age_group = get_age_group(age)
            
            for detail in order.get('details', []):
                product = detail.get('product', {})
                category = product.get('category', {})
                cat_name = category.get('name', 'Unknown')
                qty = detail.get('quantity', 0)
                
                gender_preferences[gender][cat_name] += qty
                age_preferences[age_group][cat_name] += qty
                total_revenue += float(detail.get('price', 0)) * qty
                
        # Format output
        def get_top_category(pref_dict):
            if not pref_dict:
                return "Unknown"
            return max(pref_dict.items(), key=lambda x: x[1])[0]
            
        result = {
            "gender_insights": {
                g: {"top_category": get_top_category(prefs), "stats": dict(prefs)}
                for g, prefs in gender_preferences.items() if prefs
            },
            "age_insights": {
                ag: {"top_category": get_top_category(prefs), "stats": dict(prefs)}
                for ag, prefs in age_preferences.items() if prefs
            },
            "total_analyzed_orders": len(orders)
        }
        
        print(json.dumps(result))
        
    except Exception as e:
        print(json.dumps({"error": str(e)}))

if __name__ == "__main__":
    main()
