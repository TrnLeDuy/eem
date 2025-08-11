import t from 'typy';

export default {
    methods: {
        selectSingleFile(event, model) {
            const entity = t(this, model).safeObject;

            if (typeof entity.medias_single === 'undefined') {
                this.$set(entity, 'medias_single', {});
            }

            // Đảm bảo luôn set giá trị, kể cả khi id là null (trường hợp xóa)
            this.$set(entity.medias_single, event.zone, event.id);
        },
    },
};
