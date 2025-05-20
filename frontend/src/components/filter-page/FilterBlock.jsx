const FilterBlock = ({
  data,
  title,
  subject,
  selectedItems,
  handleItemsChange,
}) => {
  return (
    <div className="container p-3">
      <div className="row items-filters">
        <h5 className="fw-bold">{title}</h5>
        {data.map((item) => {
          return (
            <div
              key={item.id}
              className="col-6 g-3 d-flex align-items-center gap-2"
            >
              <input
                type="checkbox"
                name={`${subject}s[]`}
                id={`${subject}-${item.id}`}
                value={item.name ?? item.age}
                checked={selectedItems.includes(
                  item.name ?? item.age.toString(),
                )}
                onChange={handleItemsChange}
              />
              <label htmlFor={`${subject}-${item.id}`}>
                {item.name ?? item.age}
              </label>
            </div>
          );
        })}
      </div>
    </div>
  );
};

export default FilterBlock;
