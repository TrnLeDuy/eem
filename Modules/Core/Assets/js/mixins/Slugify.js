export default {
    methods: {
        slugify(string) {
            if (!string) return '';
            let value = string.trim().toLowerCase();
            const from = "áàảãạâấầẩẫậăắằẳẵặéèẻẽẹêếềểễệíìỉĩịóòỏõọôốồổỗộơớờởỡợúùủũụưứừửữựýỳỷỹỵđ",
                to = "aaaaaaaaaaaaaaaaaeeeeeeeeeeeiiiiiooooooooooooooooouuuuuuuuuuuyyyyyd";
            for (let i = 0; i < from.length; i++) {
                value = value.replace(new RegExp(from[i], 'g'), to[i]);
            }
            value = value.replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')     
                .replace(/-+/g, '-');  
            return value;
        },
    },
};
