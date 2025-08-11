import t from 'typy';

export default {
    methods: {
        selectMultipleFile(event, model) {
            const entity = t(this, model).safeObject;

            if (typeof entity.medias_multi === 'undefined') {
                this.$set(entity, 'medias_multi', {});
            }

            if (typeof entity.medias_multi[event.zone] === 'undefined') {
                this.$set(entity.medias_multi, event.zone, { files: [], orders: '' });
            }

            if (event.id !== null && event.id !== undefined) {
                const medias = new Set(entity.medias_multi[event.zone].files);
                medias.add(event.id);
                this.$set(entity.medias_multi[event.zone], 'files', [...medias]);
                
                // Update orders if provided
                if (event.order) {
                    const orders = entity.medias_multi[event.zone].orders.split(',').filter(Boolean);
                    orders[event.order - 1] = event.id.toString();
                    this.$set(entity.medias_multi[event.zone], 'orders', orders.join(','));
                }
            }
        },
        unselectFile(event, model) {
            const entity = t(this, model).safeObject;

            if (event.id !== null && event.id !== undefined) {
                const medias = new Set(entity.medias_multi[event.zone].files);
                medias.delete(event.id);
                this.$set(entity.medias_multi[event.zone], 'files', [...medias]);

                // Update orders
                let orders = entity.medias_multi[event.zone].orders.split(',').filter(id => id != event.id);
                this.$set(entity.medias_multi[event.zone], 'orders', orders.join(','));
            }

            // Nếu không còn file nào, xóa hoàn toàn zone đó
            if (entity.medias_multi[event.zone].files.length === 0) {
                this.$set(entity.medias_multi[event.zone], 'files', []);
                this.$set(entity.medias_multi[event.zone], 'orders', '');
            }
        },
    },
};
