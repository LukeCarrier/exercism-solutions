class Matrix
  attr_reader :rows, :columns

  def initialize(matrix)
    @matrix = matrix
  end

  def rows
    @rows ||= begin
      values = []
      @matrix.lines.each do |row|
        values.append(row.split.map { |v| v.to_i })
      end
      values
    end
  end

  def columns
    rows.transpose
  end
end
